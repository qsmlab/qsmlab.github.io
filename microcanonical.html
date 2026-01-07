<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Microcanonical Ensemble Calculator</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
        }
        .input-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 5px;
        }
        #result {
            margin-top: 20px;
            white-space: pre-wrap;
            background-color: #f8f8f8;
            padding: 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Microcanonical Ensemble Calculator</h1>
        <h3>(Using particle in 1D box example)</h3>

        <div class="input-group">
            <label for="energy">Total Energy of the System (<1200 in the unit of the lowest energy of the PIB):</label>
            <input type="number" id="energy" min="1" max="1200" value="363">
        </div>

        <div class="input-group">
            <label for="particles">Number of Particles (<10):</label>
            <input type="range" id="particles" min="1" max="10" value="3">
            <span id="particles-output">3</span>
        </div>
	
        <div class="input-group">
            <label>Type of Particles (Choose one or more):</label>
            <input type="checkbox" id="boson" name="particleType" value="boson" checked>
            <label for="boson">Boson</label><br>
            <input type="checkbox" id="fermion" name="particleType" value="fermion"  checked>
            <label for="fermion">Fermion</label><br>
            <input type="checkbox" id="classical" name="particleType" value="classical"  checked>
            <label for="classical">Classical</label>
        </div>

        <button onclick="calculateMicrostates()">Calculate Microstates</button>

        <div id="result"></div>
    </div>

    <script>
        document.getElementById("particles").oninput = function() {
            document.getElementById("particles-output").textContent = this.value;
        };

        function calculateMicrostates() {
            const totalEnergy = parseInt(document.getElementById('energy').value);
            const numParticles = parseInt(document.getElementById('particles').value);
            const particleTypes = document.querySelectorAll('input[name="particleType"]:checked');
            const maxLevel = 20;

            const energyLevels = [];
            for (let i = 1; i <= maxLevel; i++) {
                energyLevels.push(i * i);
            }

            let resultText = '';
            particleTypes.forEach(type => {
                let microstates = [];
                let possibleStates;

                if (type.value === 'boson') {
                    possibleStates = combinationsWithReplacement(energyLevels, numParticles);
                    resultText += `\nBosons:\n`;
                } else if (type.value === 'fermion') {
                    possibleStates = combinations(energyLevels, numParticles);
                    resultText += `\nFermions :\n`;
                } else if (type.value === 'classical') {
                    possibleStates = cartesianProduct(energyLevels, numParticles);
                    resultText += `\nClassical particles:\n`;
                }

                for (let state of possibleStates) {
                    const total = state.reduce((acc, cur) => acc + cur, 0);
                    if (total === totalEnergy) {
                        microstates.push(state);
                    }
                }

                if (microstates.length === 0) {
                    resultText += `No microstates found for ${type.value} particles.\n`;
                } else {
                    resultText += formatResults(microstates, totalEnergy, numParticles, maxLevel);
                }
            });

            document.getElementById("result").textContent = resultText;
        }

        function formatResults(microstates, totalEnergy, numParticles, maxLevel) {
            let result = `Number of possible microstates: ${microstates.length}\n`;
            result += `Probability of each microstate: ${(1 / microstates.length).toFixed(2)}\n`;
            result += `Entropy (S): ${(Math.log(microstates.length)).toFixed(2)} (unit of kB)\n\n`;

            microstates.forEach((state, index) => {
                const sqrtState = state.map(e => Math.sqrt(e).toFixed(0));
                const occupationVector = getOccupationNumber(state, maxLevel);
                result += `Microstate ${index + 1}: (${sqrtState.join(', ')}) ; Occupation No.: [${occupationVector.join(', ')}]\n`;
            });
            return result;
        }

        function getOccupationNumber(state, maxLevel) {
            const occupationVector = Array(maxLevel).fill(0);
            state.forEach(energy => {
                const level = Math.sqrt(energy);
                occupationVector[level - 1] += 1;
            });
            return occupationVector;
        }

        function combinationsWithReplacement(arr, num) {
            if (num === 1) return arr.map(e => [e]);
            let combs = [];
            for (let i = 0; i < arr.length; i++) {
                let smaller = combinationsWithReplacement(arr.slice(i), num - 1);
                smaller.forEach(sm => combs.push([arr[i], ...sm]));
            }
            return combs;
        }

        function combinations(arr, num) {
            if (num === 1) return arr.map(e => [e]);
            let combs = [];
            for (let i = 0; i < arr.length; i++) {
                let smaller = combinations(arr.slice(i + 1), num - 1);
                smaller.forEach(sm => combs.push([arr[i], ...sm]));
            }
            return combs;
        }

        function cartesianProduct(arr, num) {
            if (num === 1) return arr.map(e => [e]);
            let prod = [];
            let rest = cartesianProduct(arr, num - 1);
            arr.forEach(e => {
                rest.forEach(sm => prod.push([e, ...sm]));
            });
            return prod;
        }
    </script>
</body>
</html>

