<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Calculator for Spectrophotometry Expt</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mathjs/10.0.0/math.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
    <style>
        #plotContainer {
            width: 80%;
            margin: 0 auto;
        }
        #departmentLabel {
            position: fixed;
            right: 20px;
            top: 20px;
            font-weight: bold;
            font-size: 16px;
        }
        #reciprocalOptions {
            margin-top: 10px;
        }
        #equationSolver {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h2>Spectrophotometric Determination of pKa of Methyl Red</h2>
    <form id="dataForm">
        <label for="xData">Concentration data (comma-separated):</label>
        <input type="text" id="xData" name="xData" required><br><br>
        
        <label for="yData">Absorbance data (comma-separated):</label>
        <input type="text" id="yData" name="yData" required><br><br>

        <label for="xLabel">X-axis Label:</label>
        <input type="text" id="xLabel" name="xLabel" placeholder="X Axis"><br><br>

        <label for="yLabel">Y-axis Label:</label>
        <input type="text" id="yLabel" name="yLabel" placeholder="Y Axis"><br><br>

        <br>
        <button type="button" onclick="plotData()">Plot and Fit</button>
        <button type="button" onclick="clearData()">Clear Data</button>
        <button type="button" onclick="exportToPDF()">Export to PDF</button>
    </form>
    
    <div id="plotContainer">
        <canvas id="plotCanvas"></canvas>
    </div>

    <p id="slopeIntercept"></p>


    <div id="equationSolver">
        <h3>Solve Two Equations with Two Variables</h3>

        <p>Equation 1: 
A<sub>λ<sub>a</sub></sub> = ε<sup>λ<sub>a</sub></sup><sub>HMR</sub> t [HMR] + ε<sup>λ<sub>a</sub></sup><sub>MR<sup>-</sup></sub> t [MR<sup>-</sup>]  
</p>
<input type="number" id="c1" placeholder="A (λa)">  =       
<input type="number" id="a1" placeholder="ε (λa, HMR) t" > [HMR] +
<input type="number" id="b1" placeholder="ε (λa, MR-) t" > [MR<sup>-</sup>] <br><br>

        <p>Equation 2: 
A<sub>λ<sub>b</sub></sub> = ε<sup>λ<sub>b</sub></sup><sub>HMR</sub> t [HMR] + ε<sup>λ<sub>b</sub></sup><sub>[MR<sup>-</sup>]</sub> t [MR<sup>-</sup>]  
</p>
<input type="number" id="c2" placeholder="A (λb)">  =       
<input type="number" id="a2" placeholder="ε (λb, HMR) t" > [HMR] +
<input type="number" id="b2" placeholder="ε (λb, MR-) t" > [MR<sup>-</sup>] <br><br>

        <button type="button" onclick="solveEquations()">Solve Equations</button>

        <p id="equationSolution"></p>
    </div>

    <script>
        let chart;

       
        function plotData(xData = null, yData = null) {
            if (!xData) {
                xData = document.getElementById("xData").value.split(",").map(Number);
            }
            if (!yData) {
                yData = document.getElementById("yData").value.split(",").map(Number);
            }
            const xLabel = document.getElementById("xLabel").value || 'X Axis';
            const yLabel = document.getElementById("yLabel").value || 'Y Axis';
	    
            if (xData.length !== yData.length) {
                alert("X and Y data must have the same length.");
                return;
            }

            const slope = calculateSlope(xData, yData);
            const intercept = calculateIntercept(xData, yData, slope);
            const fitLineData = xData.map(x => ({ x, y: slope * x + intercept }));

            if (chart) {
                chart.destroy();
            }

            const ctx = document.getElementById('plotCanvas').getContext('2d');
            chart = new Chart(ctx, {
                type: 'scatter',
                data: {
                    datasets: [
                        {
                            label: 'Data Points',
                            data: xData.map((x, i) => ({ x, y: yData[i] })),
                            borderColor: 'blue',
                            showLine: true,
                            fill: false,
                            pointBackgroundColor: 'blue',
                            pointRadius: 5
                        },
                        {
                            label: 'Best Fit Line',
                            data: fitLineData,
                            borderColor: 'red',
                            showLine: true,
                            fill: false,
                            borderWidth: 2,
                            pointRadius: 0
                        }
                    ]
                },
                options: {
                    scales: {
                        x: {
                            type: 'linear',
                            position: 'bottom',
                            title: { display: true, text: xLabel }
                        },
                        y: {
                            title: { display: true, text: yLabel }
                        }
                    }
                }
            });

            document.getElementById('slopeIntercept').textContent = 
                `Slope: ${slope.toFixed(2)}, Intercept: ${intercept.toFixed(2)}`;
        }

        function calculateSlope(xData, yData) {
            const n = xData.length;
            const sumX = math.sum(xData);
            const sumY = math.sum(yData);
            const sumXY = math.sum(xData.map((x, i) => x * yData[i]));
            const sumXX = math.sum(xData.map(x => x * x));

            return (n * sumXY - sumX * sumY) / (n * sumXX - sumX * sumX);
        }

        function calculateIntercept(xData, yData, slope) {
            const sumX = math.sum(xData);
            const sumY = math.sum(yData);
            const n = xData.length;

            return (sumY - slope * sumX) / n;
        }

        function applyReciprocal() {
            const xData = document.getElementById("xData").value.split(",").map(Number);
            const yData = document.getElementById("yData").value.split(",").map(Number);
            const reciprocalOption = document.getElementById("reciprocalSelect").value;

            let transformedX = xData;
            let transformedY = yData;

            if (reciprocalOption === 'reciprocalX') {
                transformedX = xData.map(x => 1 / x);
            } else if (reciprocalOption === 'reciprocalY') {
                transformedY = yData.map(y => 1 / y);
            } else if (reciprocalOption === 'doubleReciprocal') {
                transformedX = xData.map(x => 1 / x);
                transformedY = yData.map(y => 1 / y);
            }

            plotData(transformedX, transformedY);
        }

        function clearData() {
            document.getElementById("xData").value = "";
            document.getElementById("yData").value = "";
            document.getElementById("xLabel").value = "";
            document.getElementById("yLabel").value = "";
            document.getElementById("reciprocalSelect").value = "none";
            document.getElementById("slopeIntercept").textContent = "";
            document.getElementById("equationSolution").textContent = "";

            if (chart) {
                chart.destroy();
            }
        }

        function exportToPDF() {
            const { jsPDF } = window.jspdf;
            const pdf = new jsPDF();
            pdf.text("Linear Fit Plot", 10, 10);
            pdf.text(document.getElementById("slopeIntercept").textContent, 10, 20);

            const canvas = document.getElementById('plotCanvas');
            const imgData = canvas.toDataURL('image/png');
            pdf.addImage(imgData, 'PNG', 10, 30, 180, 100);

            pdf.save("plot.pdf");
        }

        function solveEquations() {
            const a1 = parseFloat(document.getElementById("a1").value);
            const b1 = parseFloat(document.getElementById("b1").value);
            const c1 = parseFloat(document.getElementById("c1").value);
            const a2 = parseFloat(document.getElementById("a2").value);
            const b2 = parseFloat(document.getElementById("b2").value);
            const c2 = parseFloat(document.getElementById("c2").value);

            if (isNaN(a1) || isNaN(b1) || isNaN(c1) || isNaN(a2) || isNaN(b2) || isNaN(c2)) {
                alert("Please enter valid numbers for all coefficients.");
                return;
            }

            const equations = [
                {a: a1, b: b1, c: c1},
                {a: a2, b: b2, c: c2}
            ];

            const aMatrix = [
                [equations[0].a, equations[0].b],
                [equations[1].a, equations[1].b]
            ];

            const cMatrix = [
                equations[0].c,
                equations[1].c
            ];

            try {
                const solution = math.lusolve(aMatrix, cMatrix);
                const xSolution = solution[0][0];
                const ySolution = solution[1][0];
                document.getElementById("equationSolution").textContent = 
                    `Solution: [HMR] = ${xSolution.toFixed(2)}, [MR] = ${ySolution.toFixed(2)}`;
            } catch (error) {
                document.getElementById("equationSolution").textContent = "No solution or infinite solutions exist.";
            }
        }
    </script>
</body>
</html>

