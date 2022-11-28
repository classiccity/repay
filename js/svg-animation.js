
function svg_add_path_classnames( args = { svg_target_class:'', path_target_classes: [], classname: '', remove_only: false, cleanup_callback: null, interval: 0 } ) {
	// console.log('svg_add_path_classes', args);
	let svg = document.getElementsByClassName(args.svg_target_class)[0];
	if( undefined === svg ) {
		console.warn('Not found: svg_target_class',args.svg_target_class);
		return;
	}

	// build array of the target path elements
	path_targets = [];

	for(let i=0; i < args.path_target_classes.length; i++) {
		if( typeof path_target_classes[i] === 'string' ) path_target = svg.getElementsByClassName(args.path_target_classes[i])[0];
		else path_target = args.path_target_classes[i];
		if( undefined === path_target ) {
			console.warn('Not found: path_target',path_target);
			continue;
		}
		if(args.remove_only) path_target.classList.remove(args.classname); // clear the classname
		else path_targets.push(path_target);
	}

	if(args.remove_only) return;

	window['svg_add_path_classes_args'] = {
		i: 0,
		path_targets,
		classname,
	}
	window['svg_add_path_classes_cleanup_callback'] = args.cleanup_callback;

	window['svg_add_path_classes_interval'] = setInterval(function() {
		let args = window['svg_add_path_classes_args'];
		let classname = window['svg_add_path_classes_args']['classname'];
		let i = window['svg_add_path_classes_args']['i'];

		window['svg_add_path_classes_args']['i'] = i + 1; // iterate now, to avoid race condition for next interval

		if(i < args['path_targets'].length && !document.hidden) {
			let path_target = args['path_targets'][args['i']];
				if( undefined === path_target ) {
					// console.warn('Not found: path_target', path_target, i, args['path_targets'].length, args['path_targets']);
					return;
				}
				path_target.classList.add(classname);
		} else {
			clearInterval(window['svg_add_path_classes_interval']);
			setTimeout(function(){window['svg_add_path_classes_cleanup_callback']()}, args.interval);
		}
	},
	args.interval);
}



const pop_dot_wave = function() { // DONE
	if(document.hidden) return;
	svg_target_class = window['pop_dot_wave_svg_target_class'];
	path_target_classes = ['cls-1443','cls-1458','cls-1483','cls-1480','cls-1482','cls-1433','cls-1481','cls-1432','cls-1431','cls-1487','cls-1485',
	'cls-1486','cls-1453','cls-1454','cls-1451','cls-1452','cls-1455','cls-1456','cls-1468','cls-1470','cls-1462',
	'cls-1463','cls-1497','cls-1496','cls-1492','cls-1495','cls-1494','cls-1493','cls-1508','cls-1507','cls-1510','cls-1509','cls-1529',
	'cls-1530','cls-1518','cls-1519','cls-1516','cls-1517','cls-1514','cls-1515','cls-1512','cls-1513','cls-1469','cls-1466','cls-1471','cls-1465',
	'cls-1464','cls-1467','cls-1449','cls-1461','cls-1459','cls-1460','cls-1526','cls-1522','cls-1521','cls-1520','cls-1523','cls-1528','cls-1525',
	'cls-1524','cls-1511','cls-1527','cls-1478','cls-1489','cls-1488','cls-1491','cls-1490','cls-1475','cls-1474','cls-1477','cls-1476','cls-1479',
	'cls-1484','cls-1499','cls-1500','cls-1501','cls-1498','cls-1503','cls-1504','cls-1506','cls-1502','cls-1505','cls-1824','cls-1823','cls-1827',
	'cls-1829','cls-1821','cls-1822','cls-1830','cls-1828','cls-1826','cls-1825','cls-1820','cls-1819','cls-1766','cls-1768','cls-1793','cls-1794',
	'cls-1769','cls-1770','cls-1767','cls-1765','cls-1796','cls-1764','cls-1763','cls-1759','cls-1756','cls-1758','cls-1760','cls-1757','cls-1761',
	'cls-1755','cls-1754','cls-1762','cls-1753','cls-1751','cls-1752','cls-1817','cls-1816','cls-1814','cls-1815','cls-1818','cls-1681','cls-1682',
	'cls-1683','cls-1684','cls-1685','cls-1690','cls-1686','cls-1688','cls-1687'];
	classname = 'pop';

	window['pop_dot_wave_args'] = {
		svg_target_class,
		path_target_classes,
		classname,
		remove_only: true,
		cleanup_callback: null,
		interval: 0,
	}

	window['pop_dot_wave_args_callback'] = function() {
		svg_add_path_classnames(window['pop_dot_wave_args']);
	}

	args = {
		svg_target_class,
		path_target_classes,
		classname,
		remove_only: false,
		cleanup_callback: window['pop_dot_wave_args_callback'],
		interval: 50,
	}

	svg_add_path_classnames( args );

}

const pop_dot_wave_2 = function() { // DONE
	if(document.hidden) return;
	svg_target_class = window['pop_dot_wave_2_svg_target_class'];
	let svg = document.getElementsByClassName(svg_target_class)[0];
	all_path_target_classes = svg.getElementsByClassName('cls-1');
	path_target_classes = [];
	count = 20;

	for (let i=0; i<count; i++) {
		path_target_classes.push( random_item(all_path_target_classes) );
	}

	classname = 'pop';

	window['pop_dot_wave_2_args'] = {
		svg_target_class,
		path_target_classes,
		classname,
		remove_only: true,
		cleanup_callback: null,
		interval: 0,
	}

	window['pop_dot_wave_2_args_callback'] = function() {
		svg_add_path_classnames(window['pop_dot_wave_2_args']);
	}

	args = {
		svg_target_class,
		path_target_classes,
		classname,
		remove_only: false,
		cleanup_callback: window['pop_dot_wave_2_args_callback'],
		interval: 300,
	}

	svg_add_path_classnames( args );

}


const pop_dot_circle = function() { // DONE
	if(document.hidden) return;
	svg_target_class = window['pop_dot_circle_svg_target_class'];
	path_target_classes = ['cls-157','cls-163','cls-161','cls-166','cls-164','cls-169','cls-168','cls-143','cls-145','cls-147','cls-149','cls-150','cls-200','cls-159','cls-154','cls-156','cls-152','cls-182','cls-190','cls-188','cls-186','cls-183','cls-180','cls-178'];
	classname = 'pop';

	window['pop_dot_circle_args'] = {
		svg_target_class,
		path_target_classes,
		classname,
		remove_only: true,
		cleanup_callback: null,
		interval: 0,
	}

	window['pop_dot_circle_args_callback'] = function() {
		svg_add_path_classnames(window['pop_dot_circle_args']);
	}

	args = {
		svg_target_class,
		path_target_classes,
		classname,
		remove_only: false,
		cleanup_callback: window['pop_dot_circle_args_callback'],
		interval: 150,
	}
	svg_add_path_classnames( args );

}