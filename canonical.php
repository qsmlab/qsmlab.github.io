<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Canonical Ensemble Calculator</title>
    <style>
        .input-section {
            margin-bottom: 20px;
        }
        .output {
            white-space: pre-wrap;
            background-color: #f0f0f0;
            padding: 10px;
            border-radius: 5px;
            margin-top: 20px;
            font-family: monospace;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            cursor: pointer;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
        button {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h1>Canonical Ensemble Calculator</h1>
    <h3>(Using particle in 1D box example)</h3>
    <div class="input-section">
        <label for="maxLevel">Maximum Number of 1-particle states (< 10): </label>
        <input type="number" id="maxLevel" min="1" value="5" max="10">
    </div>

    <div class="input-section">
        <label for="numParticles">Number of particles (<10): </label>
        <input type="number" id="numParticles" min="1" value="3"  max="10">
    </div>

    <div class="input-section">
        <label for="temperature">k<sub>B</sub>T (in the unit of k<sub>B</sub>): </label>
        <input type="number" id="temperature" min="1" value="10">
    </div>

    <div class="input-section">
        <label>Particle Type: </label>
        <label><input type="radio" name="particleType" value="boson" checked> Boson</label>
        <label><input type="radio" name="particleType" value="fermion"> Fermion</label>
        <label><input type="radio" name="particleType" value="classical"> Classical</label>
    </div>

    <button onclick="calculateEnsemble()">Calculate</button>

    <div id="output" class="output"></div>

    <script>
        function factorial(n) {
            return n <= 1 ? 1 : n * factorial(n - 1);
        }

        function combinations(arr, k) {
            if (k > arr.length || k <= 0) return [];
            if (k === arr.length) return [arr];
            if (k === 1) return arr.map(item => [item]);

            let result = [];
            for (let i = 0; i <= arr.length - k; i++) {
                let head = arr.slice(i, i + 1);
                let tailCombs = combinations(arr.slice(i + 1), k - 1);
                result = result.concat(tailCombs.map(comb => head.concat(comb)));
            }
            return result;
        }

        function combinationsWithReplacement(arr, k) {
            if (k === 0) return [[]];
            let result = [];
            for (let i = 0; i < arr.length; i++) {
                let head = arr[i];
                let tails = combinationsWithReplacement(arr.slice(i), k - 1);
                tails.forEach(tail => {
                    result.push([head].concat(tail));
                });
            }
            return result;
        }

        function product(arr, repeat) {
            if (repeat <= 0) return [[]];
            let result = [];
            for (let i = 0; i < arr.length; i++) {
                let rest = product(arr, repeat - 1);
                for (let j = 0; j < rest.length; j++) {
                    result.push([arr[i]].concat(rest[j]));
                }
            }
            return result;
        }

        function calculateMicrostates(numParticles, particleType, maxLevel = 5) {
            const energyLevels = Array.from({ length: maxLevel }, (_, n) => (n + 1) ** 2);
            let microstates = [];

            if (particleType === 'boson') {
                microstates = combinationsWithReplacement(energyLevels, numParticles);
            } else if (particleType === 'fermion') {
                microstates = combinations(energyLevels, numParticles);
            } else if (particleType === 'classical') {
                microstates = product(energyLevels, numParticles);
            }

            return microstates;
        }

        function occupationNumberRepresentation(state, maxLevel) {
            let occupationVector = Array(maxLevel).fill(0);
            state.forEach(energy => {
                const level = Math.sqrt(energy);
                occupationVector[level - 1]++;
            });
            return occupationVector;
        }

        function calculatePartitionFunctionAndProperties(microstates, beta, maxLevel) {
            let partitionFunction = 0;
            let internalEnergy = 0;
            const stateProperties = [];

            microstates.forEach((state, index) => {
                const stateEnergy = state.reduce((sum, energy) => sum + energy, 0);
                const boltzmannFactor = Math.exp(-beta * stateEnergy);

                partitionFunction += boltzmannFactor;
                internalEnergy += stateEnergy * boltzmannFactor;

                const occupationVector = occupationNumberRepresentation(state, maxLevel);

                stateProperties.push({
                    index: index + 1,
                    state,
                    stateEnergy,
                    boltzmannFactor,
                    occupationVector
                });
            });

            internalEnergy /= partitionFunction;

            return { partitionFunction, internalEnergy, stateProperties };
        }

        function displayResults({ partitionFunction, internalEnergy, stateProperties }) {
            let output = `<p>Total Partition Function (Z): ${partitionFunction.toFixed(5)}</p>`;
            output += `<p>Total Internal Energy (U): ${internalEnergy.toFixed(5)}</p>`;
            output += `<p>Number of Microstates: ${stateProperties.length.toFixed(0)}</p>`;

            output += `<table id="stateTable">
                            <thead>
                                <tr>
                                    <th onclick="sortTable(0)">Index</th>
                                    <th onclick="sortTable(1)">Energy Levels</th>
                                    <th onclick="sortTable(2)">Occupation Number</th>
                                    <th onclick="sortTable(3)">State Energy (rel ene)</th>
                                    <th onclick="sortTable(4)">Boltzmann Factor</th>
                                    <th onclick="sortTable(5)">Probability</th>
                                    <th onclick="sortTable(6)">Energy Contribution</th>
                                </tr>
                            </thead>
                            <tbody>`;

            const lowestEnergy = Math.min(...stateProperties.map(props => props.stateEnergy));

            stateProperties.forEach((props, index) => {
                if (index < 120) { // Display only first 120 rows initially
                    const probability = props.boltzmannFactor / partitionFunction;
                    const energyContribution = probability * props.stateEnergy;
                    const relativeEnergy = props.stateEnergy - lowestEnergy;

                    output += `<tr>
                                    <td>${props.index}</td>
                                    <td>(${props.state.map(e => Math.sqrt(e)).join(', ')})</td>
                                    <td>[${props.occupationVector.join(', ')}]</td>
                                    <td>${props.stateEnergy.toFixed(2)} (${relativeEnergy.toFixed(2)})</td>
                                    <td>${props.boltzmannFactor.toFixed(5)}</td>
                                    <td>${probability.toFixed(5)}</td>
                                    <td>${energyContribution.toFixed(5)}</td>
                                </tr>`;
                }
            });

            output += `</tbody></table>`;
            output += `<button id="expandButton" onclick="expandResults()">Expand for all states</button>`;

            document.getElementById('output').innerHTML = output;
        }

        function expandResults() {
            const stateTable = document.getElementById('stateTable').getElementsByTagName('tbody')[0];
            const rows = stateTable.rows.length;
            const expandButton = document.getElementById('expandButton');

            for (let i = rows; i < stateProperties.length; i++) {
                const props = stateProperties[i];
                const probability = props.boltzmannFactor / partitionFunction;
                const energyContribution = probability * props.stateEnergy;
                const relativeEnergy = props.stateEnergy - lowestEnergy;

                const row = stateTable.insertRow();
                row.innerHTML = `<td>${props.index}</td>
                                 <td>${props.state.map(e => Math.sqrt(e)).join(', ')}</td>
                                 <td>${props.occupationVector.join(', ')}</td>
                                 <td>${props.stateEnergy.toFixed(2)} (${relativeEnergy.toFixed(2)})</td>
                                 <td>${props.boltzmannFactor.toFixed(5)}</td>
                                 <td>${probability.toFixed(5)}</td>
                                 <td>${energyContribution.toFixed(5)}</td>`;
            }
            expandButton.remove(); // Remove the expand button after expanding all states
        }

        function sortTable(columnIndex) {
            const table = document.getElementById('stateTable');
            const rows = Array.from(table.rows).slice(1); // Get all rows except the header
            let sortedRows;

            sortedRows = rows.sort((a, b) => {
                const cellA = a.cells[columnIndex].innerText;
                const cellB = b.cells[columnIndex].innerText;
                const valA = isNaN(parseFloat(cellA)) ? cellA : parseFloat(cellA);
                const valB = isNaN(parseFloat(cellB)) ? cellB : parseFloat(cellB);
                return valA > valB ? 1 : -1;
            });

            sortedRows.forEach(row => table.appendChild(row));
        }

        function calculateEnsemble() {
            const numParticles = parseInt(document.getElementById('numParticles').value);
            const temperature = parseInt(document.getElementById('temperature').value);
	    const maxLevel = parseInt(document.getElementById('maxLevel').value);
            const particleType = document.querySelector('input[name="particleType"]:checked').value;
	    const beta = 1 / temperature;
            
            const microstates = calculateMicrostates(numParticles, particleType, maxLevel);
            const result = calculatePartitionFunctionAndProperties(microstates, beta, maxLevel);
            displayResults(result);
        }
    </script>
<p>
When <i>n</i> particles are arranged in <i>k</i> boxes  (<i>n ≤ k</i>), the number of microstates depends on the nature of the particles. 
<br>For <b>classical particles</b> (distinguishable and can occupy box independently), 
the total number of microstates is <code>k<sup>n</sup></code>. 
<br>For <b>bosons</b> (indistingusihable and can occupy the same box without restriction),  
the number of microstates is <code>C(n + k - 1, n)</code>.
<br>For <b>fermions</b> (indistinguishable but at most one particle per box), 
the number of microstates is <code>C(k, n)</code>. 
<br>
The combination function  <code>C(k, n) = k! / (n! (k - n)!)</code>.
</p>
</body>
</html>

