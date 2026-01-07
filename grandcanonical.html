<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grand Canonical Ensemble Calculator</title>
    <style>
        /* Same CSS styling */
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
    <h1>Grand Canonical Ensemble Calculator</h1>
    <h3>(Using particle in 1D box example)</h3>

    <div class="input-section">
        <label for="maxParticles">Maximum number of particles (<10): </label>
        <input type="number" id="maxParticles" min="1" value="3" max="10">
    </div>

    <div class="input-section">
        <label for="maxLevel">Maximum Energy Level (<10): </label>
        <input type="number" id="maxLevel" min="1" value="5" max="10">
    </div>

    <div class="input-section">
        <label for="temperature">k<sub>B</sub>T (in the unit of k<sub>B</sub>): </label>
        <input type="number" id="temperature" min="1" value="10">
    </div>

    <div class="input-section">
        <label for="chemicalPotential">Chemical Potential (μ): </label>
        <input type="number" id="chemicalPotential" value="-5">
    </div>

    <div class="input-section">
        <label>Particle Type: </label>
        <label><input type="radio" name="particleType" value="boson" checked> Boson</label>
        <label><input type="radio" name="particleType" value="fermion"> Fermion</label>
        <label><input type="radio" name="particleType" value="classical"> Classical</label>
    </div>

    <button onclick="calculateGrandCanonicalEnsemble()">Calculate</button>

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

        function calculateMicrostates(numParticles, particleType, maxLevel) {
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

        function calculateGrandPotentialAndProperties(microstates, beta, mu, numParticles, maxLevel) {
            let partitionFunction = 0;
            let stateProperties = [];

            microstates.forEach((state, index) => {
                const stateEnergy = state.reduce((sum, energy) => sum + energy, 0);
                const grandEnergy = stateEnergy - numParticles * mu;
                const boltzmannFactor = Math.exp(-beta * grandEnergy);
		partitionFunction += boltzmannFactor;
		
                

                const occupationVector = occupationNumberRepresentation(state, maxLevel);

                stateProperties.push({
                    index: index + 1,
                    numParticles,
                    state,
                    stateEnergy,
                    grandEnergy, 
                    boltzmannFactor,
                    occupationVector
                });
            });

            return { partitionFunction, stateProperties };
        }

        function displayGrandCanonicalResults({ partitionFunction, statePropertiesByParticles }) {
            let output = `<p>Total Partition Function (Z): ${partitionFunction.toFixed(5)}</p>`;
	    output += `<p>Total Number of Microstates: ${Object.values(statePropertiesByParticles).flat().length}</p>`;

            Object.keys(statePropertiesByParticles).forEach(particleNum => { 
                const stateProperties = statePropertiesByParticles[particleNum];
                output += `<p>Microstates for ${particleNum} particles (Number of states: ${stateProperties.length})</p>`;
                output += `<table id="stateTable_${particleNum}">
                                <thead>
                                    <tr>
                                        <th>Index</th>	
					<th>No. Particles</th>                                        
                                        <th>Energy Levels</th>
                                        <th>Occupation Number</th>
                                        <th>State Energy</th>
                                        <th>Grand Energy</th>
                                        <th>Boltzmann Factor</th>
                                        <th>Probability</th>
                                    </tr>
                                </thead>
                                <tbody>`;

                stateProperties.forEach(props => {
                    const probability = props.boltzmannFactor / partitionFunction;
                    output += `<tr>
                                    <td>${props.index}</td>
				    <td>${props.numParticles}</td>
                                    <td>(${props.state.map(e => Math.sqrt(e)).join(', ')})</td>
                                    <td>[${props.occupationVector.join(', ')}]</td>
                                    <td>${props.stateEnergy.toFixed(2)}</td>
                                    <td>${props.grandEnergy.toFixed(2)}</td>
                                    <td>${props.boltzmannFactor.toFixed(5)}</td>
                                    <td>${probability.toFixed(5)}</td>
                                </tr>`;
                });

                output += `</tbody></table>`;
            });

            document.getElementById('output').innerHTML = output;
        }
        function calculateGrandCanonicalEnsemble() {
            const maxParticles = parseInt(document.getElementById('maxParticles').value);
            const maxLevel = parseInt(document.getElementById('maxLevel').value);
            const temperature = parseInt(document.getElementById('temperature').value);
            const mu = parseFloat(document.getElementById('chemicalPotential').value);
            const particleType = document.querySelector('input[name="particleType"]:checked').value;
            const beta = 1 / temperature;

            let totalPartitionFunction = 0;
            const statePropertiesByParticles = {};

            for (let numParticles = 1; numParticles <= maxParticles; numParticles++) {
                const microstates = calculateMicrostates(numParticles, particleType, maxLevel);
                const result = calculateGrandPotentialAndProperties(microstates, beta, mu, numParticles, maxLevel);

                totalPartitionFunction += result.partitionFunction;
                statePropertiesByParticles[numParticles] = result.stateProperties;
            }

            displayGrandCanonicalResults({
                partitionFunction: totalPartitionFunction,
                statePropertiesByParticles
            });
        }
    </script>
</body>
</html>

