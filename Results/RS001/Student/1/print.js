function printDiv() {
    alert("This is Not Styled Print😊🙂");
    var divContents = document.querySelector(".printArea").innerHTML;
    var a = window.open('', '', 'height=900, width=800');
    a.document.write('<html>');
    a.document.write('<body > <h1>Div contents are <br>');
    a.document.write(divContents);
    a.document.write('</body></html>');
    a.document.close();
    a.print();
}