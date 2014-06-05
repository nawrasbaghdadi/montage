var mydate = new Date()
var year = mydate.getYear()
if (year < 1000)
    year += 1900
var day = mydate.getDay()


function ClearText(textBox, textToClear) {
    if (textBox.value == textToClear)
        textBox.value = '';
}

function SetDefaultText(textBox, textToSet) {
    if (textBox.value == '')
        textBox.value = textToSet;
}

