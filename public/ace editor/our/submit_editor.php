<head>
<style type="text/css" media="screen">
.ace_editor {
	position: relative !important;
	border: 1px solid lightgray;
	margin: auto;
	height: 500px;
	width: 100%;
}

.ace_editor.fullScreen {
	height: auto;
	width: auto;
	border: 0;
	margin: 0;
	position: fixed !important;
	top: 0;
	bottom: 0;
	left: 0;
	right: 0;
	z-index: 10;
}

.fullScreen {
	overflow: hidden
}

.scrollmargin {
	height: 500px;
	text-align: center;
}

.large-button {
	color: lightblue;
	cursor: pointer;
	font: 30px arial;
	padding: 20px;
	text-align: center;
	border: medium solid transparent;
	display: inline-block;
}
.large-button:hover {
	border: medium solid lightgray;
	border-radius: 10px 10px 10px 10px;
	box-shadow: 0 0 12px 0 lightblue;
}
</style>
</head>

<pre id="editor" >
<?php
echo htmlspecialchars('#include<iostream>
using namespace std;
int main()
{
	//put your code here
}'
);?>
</pre>

<script src=<?php echo $host.'/public/ace%20editor/src/ace.js';?>></script>
<script src=<?php echo $host.'/public/ace%20editor/src/ext-themelist.js';?>></script>
<script>


// create first editor
var editor = ace.edit("editor");
editor.setTheme("ace/theme/twilight");
editor.session.setMode("ace/mode/c_cpp");
editor.renderer.setScrollMargin(10, 10);
editor.setOptions({
    // "scrollPastEnd": 0.8,
    autoScrollEditorIntoView: true
});


</script>

