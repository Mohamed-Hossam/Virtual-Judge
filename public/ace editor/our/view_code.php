<head>
<style type="text/css" media="screen">
.code {
	position: relative !important;
	border: 1px solid lightgray;
	margin: auto;
	height: 500px;
	width: 100%;
}

#coe{
    position: absolute;
    border: 5px solid gray;
    padding: 5px;
    background: white;
    width: 80%;
    height: 400px;
    overflow-y: scroll;
}
</style>
</head>
<body>



<div id="code" ace-theme="ace/theme/twilight" ace-gutter="true" style="overflow:scroll; height:500px;">
</div>
<script src=<?php echo $host.'/public/ace%20editor/src/ace.js';?>></script>
<script src=<?php echo $host.'/public/ace%20editor/src/ext-static_highlight.js';?>></script>
</body>
</html>
