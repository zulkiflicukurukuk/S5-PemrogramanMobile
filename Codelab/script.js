function sum() {
    const num1 = parseFloat(document.getElementById('number1').value);
    const num2 = parseFloat(document.getElementById('number2').value);
    const result = num1 + num2;
    document.getElementById('result').innerText = 'Hasil: ' + result;
}

function reset() {
    document.getElementById('number1').value = '';
    document.getElementById('number2').value = '';
    document.getElementById('result').innerText = 'Hasil: ';
}
