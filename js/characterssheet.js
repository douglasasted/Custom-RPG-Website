function ValueChanged (_id, _valname, _val) 
{
    _val.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');
    
    if (parseInt(_val) > 20) 
        _val = '20';
    else if (parseInt(_val) == 0) 
        _val = '1';

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

function FocusChanged (_val)
{
    if (_val == '') 
    {
        _val = '1';
    }

    return _val;
}