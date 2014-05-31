<?php
    
	// SyntaxHighlighter inclusion
	$sh = <<<SH
		<link href="../syntaxhighlighter_3.0.83/styles/shCore.css" rel="stylesheet" type="text/css" />
		<link href="../syntaxhighlighter_3.0.83/styles/shThemeDefault.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="../syntaxhighlighter_3.0.83/scripts/shCore.js"></script>
	    <script type="text/javascript" src="../syntaxhighlighter_3.0.83/scripts/shBrushJScript.js"></script>
SH;
	
	/**
	 * parse the file searching for the first CDATA block,
	 * returing its contents for synta highlighter
	 * @param string $file is the absolute path of the file
	 */
	function generate_sh_code($file) {
		$content = trim(file_get_contents($file));
		$start = strpos($content, "CDATA") + 6;
		$end = strpos($content, "//]]>") - $start;
		echo file_get_contents($file, null, null, $start, $end);
	} 