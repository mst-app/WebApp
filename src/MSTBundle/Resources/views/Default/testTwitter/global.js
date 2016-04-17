$(document).readey(function()
{
    var users = new Bloodhound(
    {
        datumTokenizer:Bloodhound.tokenizers.obj.whitespace('username'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        remote: 'users.php?query=%QUERY'
    });

    users.initialize();

    $('#userss').typeahead(
    {
        hint: true,
        highlight: true,
        minLength: 2
    },{
        name:'users',
        displayKey: 'username',
        source: users.ttAdapter()
    });
});
