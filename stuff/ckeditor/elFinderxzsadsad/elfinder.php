<script type="text/javascript" charset="utf-8">
    // Helper function to get parameters from the query string.
    function getUrlParam(paramName) {
        var reParam = new RegExp('(?:[\?&]|&amp;)' + paramName + '=([^&]+)', 'i') ;
        var match = window.location.search.match(reParam) ;

        return (match && match.length > 1) ? match[1] : '' ;
    }

    $().ready(function() {
        var funcNum = getUrlParam('CKEditorFuncNum');

        var elf = $('#elfinder').elfinder({
            url : 'php/connector.php',
            getFileCallback : function(file) {
                window.opener.CKEDITOR.tools.callFunction(funcNum, file.url);
                elf.destroy();
                window.close();
            },
            resizable: false
        }).elfinder('instance');
    });
</script>