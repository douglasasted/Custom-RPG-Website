function ValueChanged (val) 
{
    val.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
    
    if (parseInt(val) > 20) 
        val = '20';
    else if (parseInt(val) == 0) 
        val = '1';
    
    return val;
}

function FocusChanged (_id, _valname, _val)
{
    if (_val == '') 
    {
        _val = '1';
    }

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "includes/characterssheet.inc.php", true);
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onreadystatechange = function() 
    {
        if (this.readyState == 4 && this.status == 200) 
        {
            // Response
            console.log(this.responseText);
        }
    };

    xhr.send(JSON.stringify({
        id : _id,
        valname : _valname,
        val : _val
    }));

    return _val;
}