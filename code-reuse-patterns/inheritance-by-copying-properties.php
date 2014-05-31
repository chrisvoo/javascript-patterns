<?php 
	$basedir = realpath(dirname(__FILE__)."/../");
	$curfile = $basedir.$_SERVER['PHP_SELF'];
	include "$basedir/include/funcs.php"; 
?>
<!doctype html>
<html lang="en">
	<head>
		<title>JavaScript Patterns - Inheritance by Copying Properties</title>
		<meta charset="utf-8">
		<?php echo $sh; ?>
		<link rel="stylesheet" type="text/css" href="/include/style.css" />		
	</head>
	<body>
		<pre class="brush: js">
			<?php generate_sh_code($curfile); ?>
		</pre>	
		<script type="text/javascript">//<![CDATA[
			/* Title: Inheritance by Copying Properties
			 * Description: an object gets functionality from another object, simply by copying it
			 * jQuery implementation: http://api.jquery.com/jquery.extend/ 
		     * Reference: http://shop.oreilly.com/product/9780596806767.do 
			 * Object copying: http://en.wikipedia.org/wiki/Object_copy
			 */

			/* shallow copy: in the process of shallow copying parent, 
			 * child will copy all of parent's field values. If the field value is 
			 * a memory address it copies the memory address, and if the field value 
			 * is a primitive type it copies the value of the primitive type. 
			 * The disadvantage is if you modify the memory address that one of child's 
			 * fields point to, you are also modifying what parent's fields point to.*/
			function extend(parent, child) {
				var i;
				child = child || {};
				for (i in parent) {
					if (parent.hasOwnProperty(i)) {
						child[i] = parent[i];
					}
				}
				return child;
			}

			var dad = {name:"Adam"};
			var kid = extend(dad);
			console.log(kid.name); // "Adam"

			var dad = {
				counts:[1, 2, 3],
				reads:{paper:true}
			};
			var kid = extend(dad);
			kid.counts.push(4);
			console.log(dad.counts.toString()); // "1,2,3,4"
			console.log(dad.reads === kid.reads); // true


			/* deep copy: recursive call of the function. 
			* The advantage is that parent and child do not depend on each 
			* other but at the cost of a slower and more expensive copy */
			function extendDeep(parent, child) {
				var i,
						toStr = Object.prototype.toString,
						astr = "[object Array]";

				child = child || {};

				for (i in parent) {
					if (parent.hasOwnProperty(i)) {
						if (typeof parent[i] === 'object') {
							child[i] = (toStr.call(parent[i]) === astr) ? [] : {};
							extendDeep(parent[i], child[i]);
						} else {
							child[i] = parent[i];
						}
					}
				}
				return child;
			}

			var dad = {
				counts:[1, 2, 3],
				reads:{paper:true}
			};
			var kid = extendDeep(dad);

			kid.counts.push(4);
			console.log(kid.counts.toString()); // "1,2,3,4"
			console.log(dad.counts.toString()); // "1,2,3"

			console.log(dad.reads === kid.reads); // false
			kid.reads.paper = false;

		//]]>
		</script>
		<script type="text/javascript">
		     SyntaxHighlighter.all()
		</script>			
	</body>
</html>