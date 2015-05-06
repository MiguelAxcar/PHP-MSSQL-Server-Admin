	<div id="footer">
		<p>Copyleft &copy; 2009 - PHP Query Analyzer is under <a href='COPYING'>GNU GPL V3</a>.<br>Written by <a href="Stuff-and-contact.php">Luiz Miguel Axcar</a>. Layout kindly designed by <a href="http://www.freecsstemplates.org">Free CSS Templates</a></p>
	</div>

	<script type="text/javascript">
		var editor = CodeMirror.fromTextArea(document.getElementById("textareaQuery"), {
    		lineNumbers: true,
            mode: 'text/x-sql',
            indentWithTabs: true,
            smartIndent: true,
            lineNumbers: true,
            matchBrackets : true,
            autofocus: true,
            extraKeys: {"Ctrl-Space": "autocomplete"},
            hintOptions: {tables: {
                users: {name: null, score: null, birthDate: null},
                countries: {name: null, population: null, size: null}
            }}
    	});

    	editor.setOption("theme", "eclipse");

    	function setCode(value) {
    		editor.setValue(value);
    	}

    	function getCode() {
    		return editor.getValue();
    	}
	</script>
