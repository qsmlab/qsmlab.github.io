<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml'>
<head>
<meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1' />
<link rel='stylesheet' type='text/css' href='menu_style.css' />
<title></title>

</head>
<body>
<ul class="menu red">
        <li><a href="index.php" title="">Home</a></li>
     <li><a href="group.php" title="">Group</a></li>
        <li><a href="pubs.php" title="" >Publications</a></li>
        <li><a href="research.php" title="">Research</a></li>
        <li><a href="teaching.php" title="">Teaching</a></li>
        <li><a href="misc.php" title="">Miscellaneous</a></li>
</ul>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }
        h1 {
            text-align: center;
        }
        .member-container {
            width: calc(49% - 20px); /* Adjust the width as needed */
            height: 250px; /* Adjust the width as needed */
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
            overflow: scroll;
            box-sizing: border-box;
            float: left;
        }
        .member-container:nth-child(odd) {
            margin-right: 20px; /* Add margin to create space between columns */
        }
        .member-info {
            overflow: hidden;
        }
        .member-info p {
            margin: 5px 0;
        }
    </style>


<head>
  <meta charset="UTF-8" />
  <title>Slater Determinants and Spin-Adapted CSFs</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 20px;
    }
    input {
      margin: 5px;
    }
    table {
      border-collapse: collapse;
      margin-bottom: 30px;
    }
    th, td {
      border: 1px solid #444;
      padding: 8px 12px;
      text-align: center;
    }
    .empty { color: #aaa; }
    .up { background-color: #c8e6c9; color: green; font-weight: bold; }
    .down { background-color: #ffcdd2; color: darkred; font-weight: bold; }
    .pair { background-color: #c5cae9; color: navy; font-weight: bold; }
    .header {
      font-size: 18px;
      margin-top: 20px;
      margin-bottom: 5px;
    }
    .warning {
      color: red;
      font-style: italic;
    }
  </style>
</head>
<body>
  <h2>Slater Determinants and Spin-Adapted CSFs</h2>
  <label># spatial orbitals: <input type="number" id="orbitals" value="2" min="1"></label>
  <label># electrons: <input type="number" id="electrons" value="2" min="0"></label>
  <button onclick="generateCSFs()">Generate</button>

  <div id="summary"></div>
  <div id="total"></div>
  <div id="output"></div>

<script>
function factorial(n) {
  if (n < 0) return 0;
  let res = 1;
  for (let i = 1; i <= n; i++) res *= i;
  return res;
}

function comb(n, k) {
  if (k < 0 || k > n) return 0;
  return factorial(n) / (factorial(k) * factorial(n - k));
}

function generateCSFs() {
  const nOrbitals = parseInt(document.getElementById("orbitals").value);
  const nElectrons = parseInt(document.getElementById("electrons").value);
  const maxAllowed = 12;

  // Clear previous output
  document.getElementById("summary").innerHTML = "";
  document.getElementById("total").innerHTML = "";
  document.getElementById("output").innerHTML = "";

  // Check for large inputs
  if (nOrbitals > maxAllowed || nElectrons > maxAllowed) {
    document.getElementById("summary").innerHTML = `<p class="warning">Input too large /Please use orbitals and electrons less than or equal to ${maxAllowed}.</p>`;
    return;
  }


  // Generate all possible configurations (Slater determinants)
  const configs = [];
  generateRec(configs, [], nOrbitals, nElectrons, 0);

  // Group determinants by multiplicity
  const grouped = {};
  configs.forEach(conf => {
    let up = conf.filter(x => x === '↑').length;
    let down = conf.filter(x => x === '↓').length;
    let multiplicity = Math.abs(up - down) + 1;
    if (!grouped[multiplicity]) grouped[multiplicity] = [];
    grouped[multiplicity].push(conf);
  });

  // Compute total determinants
  const totalDet = comb(2 * nOrbitals, nElectrons);
  document.getElementById("total").innerHTML = `<h3>Total number of Slater Determinants: ${totalDet}</h3>`;

  // Compute CSFs using the formula
  const csfData = {};
  for (let s = 0; s <= nElectrons/2; s += 0.5) {
    const m1 = (nElectrons/2) - s;
    const m2 = (nElectrons/2) + s + 1;
    if (Number.isInteger(m1) && Number.isInteger(m2) &&
        m1 >= 0 && m1 <= nOrbitals + 1 &&
        m2 >= 0 && m2 <= nOrbitals + 1) {
      const count = ((2*s + 1) / (nOrbitals + 1)) *
                    comb(nOrbitals + 1, m1) *
                    comb(nOrbitals + 1, m2);
      if (count > 0) {
        const mult = 2*s + 1;
        csfData[mult] = count;
      }
    }
  }

  // Combined table
  let summaryHTML = "<h3>Summary: Determinants & CSFs</h3><table><tr><th>Spin Multiplicity</th><th># Determinants</th><th># CSFs</th></tr>";
  const multiplicities = new Set([...Object.keys(grouped), ...Object.keys(csfData)]);
  Array.from(multiplicities).sort((a,b)=>a-b).forEach(mult => {
    const detCount = grouped[mult] ? grouped[mult].length : 0;
    const csfCount = csfData[mult] !== undefined ? csfData[mult] : 0;
    summaryHTML += `<tr><td>${mult}</td><td>${detCount}</td><td>${csfCount}</td></tr>`;
  });
  summaryHTML += "</table>";
  document.getElementById("summary").innerHTML = summaryHTML;

  // Display configurations grouped by multiplicity
  let html = "";
  for (let mult of Object.keys(grouped).sort((a,b)=>a-b)) {
    const confs = grouped[mult];
    html += `<div class="header">Spin Multiplicity ${mult} (${confs.length} determinants)</div>`;
    if (confs.length > 100) {
      html += `<p class="warning">Too many determinants (${confs.length}). Showing only first 100.</p>`;
    }
    const displayConfs = confs.length > 100 ? confs.slice(0,100) : confs;

    html += `<table><thead><tr><th>#</th>`;
    for (let i = 0; i < nOrbitals; i++) {
      html += `<th>Orb ${i+1}</th>`;
    }
    html += `</tr></thead><tbody>`;

    displayConfs.forEach((conf, idx) => {
      html += `<tr><td>${idx+1}</td>`;
      conf.forEach(occ => {
        let cls = "empty", sym = "○";
        if (occ === "↑") { cls = "up"; sym = "↑"; }
        else if (occ === "↓") { cls = "down"; sym = "↓"; }
        else if (occ === "↑↓") { cls = "pair"; sym = "↑↓"; }
        html += `<td class="${cls}">${sym}</td>`;
      });
      html += `</tr>`;
    });

    html += `</tbody></table>`;
  }
  document.getElementById("output").innerHTML = html;
}

function generateRec(configs, current, nOrbitals, remaining, idx) {
  if (idx === nOrbitals) {
    if (remaining === 0) configs.push([...current]);
    return;
  }
  if (remaining >= 2) {
    current.push('↑↓');
    generateRec(configs, current, nOrbitals, remaining-2, idx+1);
    current.pop();
  }
  if (remaining >= 1) {
    current.push('↓');
    generateRec(configs, current, nOrbitals, remaining-1, idx+1);
    current.pop();
  }
  if (remaining >= 1) {
    current.push('↑');
    generateRec(configs, current, nOrbitals, remaining-1, idx+1);
    current.pop();
  }
  current.push('○');
  generateRec(configs, current, nOrbitals, remaining, idx+1);
  current.pop();
}
</script>
</body>
</html>

