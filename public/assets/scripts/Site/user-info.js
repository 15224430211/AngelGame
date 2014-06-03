$(function() {
    $('#edit-intro').click(function() {
        $(this).hide();
        $(this).next(":hidden").show();
        var $textarea = '<textarea class="form-control" id="content-intro" rows="8" maxlength="150">' + $('p#content-intro').text() + '</textarea>';
        $('p#content-intro').replaceWith($textarea);
    });
    $('#cancel-intro').click(function() {
        textareaTo_P();
    });
    $('#save-intro').click(function() {
        $(this).button('loading');
        $.post('/setting/intro', {"intro": escape($('textarea#content-intro').val())}, function(data) {
            if (data === 'success') {
                window.location.reload();
            } else {
                alert(data);
            }
            $('#save-intro').button('reset');
        });
    });
});
var textareaTo_P = function() {
    $('#save-intro').parent().hide();
    $('#save-intro').parent().prev(":hidden").show();
    var $textarea = '<p id="content-intro">' + $('textarea#content-intro').val() + '</textarea>';
    $('textarea#content-intro').replaceWith($textarea);
};
// 将HTML转义为实体
function escape(html) {
    var elem = document.createElement('div');
    var txt = document.createTextNode(html);
    elem.appendChild(txt);
    return elem.innerHTML;
}
// 将实体转回为HTML
function unescape(str) {
    var elem = document.createElement('div');
    elem.innerHTML = str;
    return elem.innerText || elem.textContent;
}