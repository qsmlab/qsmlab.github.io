<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Michaelis-Menten Kinetics Plotter</title>
    <script src="https://cdn.plot.ly/plotly-latest.min.js"></script>
    <style>
        body {
            font-family: sans-serif;
            margin: 20px;
        }
        .substrate-set {
            border: 1px solid #aaa;
            padding: 10px;
            margin-bottom: 10px;
            position: relative;
        }
        .input-group {
            margin: 5px 0;
        }
        label {
            width: 80px;
            display: inline-block;
        }
        button {
            margin-right: 5px;
        }
        .remove-btn {
            position: absolute;
            top: 5px;
            right: 10px;
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 3px 8px;
            cursor: pointer;
            font-size: 14px;
            border-radius: 4px;
        }
    </style>
</head>
<body>
<h2>Michaelis-Menten Kinetics Plotter</h2>
<div>
    <label>[S] max (µM):</label>
    <input type="number" id="smax" value="200">
    <button onclick="addSubstrate()">Add Substrate System</button>
    <button onclick="plotAll()">Plot All</button>
    <button onclick="clearAll()">Clear All</button>
</div>

<div id="substrate-container"></div>

<hr>
<div id="plot1" style="width: 48%; display:inline-block;"></div>
<div id="plot2" style="width: 48%; display:inline-block;"></div>

<script>
    let substrateCount = 0;

    function addSubstrate() {
        substrateCount++;
        const container = document.getElementById('substrate-container');
        const div = document.createElement('div');
        div.className = 'substrate-set';
        div.setAttribute('data-id', substrateCount);

        div.innerHTML = `
            <button class="remove-btn" onclick="removeSubstrate(this)">❌ Remove</button>
            <strong>System ${substrateCount}</strong>
            <div class="input-group"><label>Label:</label><input type="text" value="System ${substrateCount}" class="label"></div>
            <div class="input-group"><label>Km (µM):</label><input type="number" value="50" class="km"></div>
            <div class="input-group"><label>kcat (/s):</label><input type="number" value="100" class="kcat"></div>
            <div class="input-group"><label>[E] (µM):</label><input type="number" value="1" class="e"></div>
        `;
        container.appendChild(div);
    }

    function removeSubstrate(button) {
        const div = button.parentNode;
        div.parentNode.removeChild(div);
    }

    function clearAll() {
        document.getElementById('substrate-container').innerHTML = '';
        substrateCount = 0;
        Plotly.purge('plot1');
        Plotly.purge('plot2');
    }

    function plotAll() {
        const sets = document.getElementsByClassName('substrate-set');
        const Smax = parseFloat(document.getElementById('smax').value);
        let dataMM = [], dataLB = [];

        for (let i = 0; i < sets.length; i++) {
            const set = sets[i];
            const Km = parseFloat(set.querySelector('.km').value);
            const kcat = parseFloat(set.querySelector('.kcat').value);
            const E = parseFloat(set.querySelector('.e').value);
            const label = set.querySelector('.label').value;
            const Vmax = kcat * E;

            let S = [], v = [], invS = [], invV = [];

            for (let s = 1; s <= Smax; s += Smax / 50) {
                let velocity = Vmax * s / (Km + s);
                S.push(s);
                v.push(velocity);
                invS.push(1 / s);
                invV.push(1 / velocity);
            }

            dataMM.push({
                x: S, y: v, mode: 'lines+markers', name: label
            });

            dataMM.push({
                x: [0, Smax],
                y: [Vmax, Vmax],
                mode: 'lines',
                name: `${label} Vmax`,
                line: { dash: 'dot', color: 'gray' },
                showlegend: false
            });

            dataMM.push({
                x: [Km],
                y: [Vmax / 2],
                mode: 'markers',
                name: `${label} Km`,
                marker: { size: 10, symbol: 'circle', color: 'red' }
            });

            dataLB.push({
                x: invS,
                y: invV,
                mode: 'lines+markers',
                name: label
            });
        }

        Plotly.newPlot('plot1', dataMM, {
            title: 'Michaelis-Menten Plot',
            xaxis: { title: '[S] (µM)' },
            yaxis: { title: 'v (µM/s)' }
        });

        Plotly.newPlot('plot2', dataLB, {
            title: 'Lineweaver-Burk Plot',
            xaxis: { title: '1/[S] (1/µM)' },
            yaxis: { title: '1/v (s/µM)' }
        });
    }

    // Add first system by default
    addSubstrate();
</script>

</body>
</html>


