<!-- start : repay/app/public/wp-content/themes/repay/template-parts/svg-animation.php -->
<?php

	$prefix = prefix() . '-svg-animation';

	$default_args = array(
		'modifier_class' => '',
		'svg' => 'dot-circle', // 'dot-circle' 'dot-wave' 'dot-wave-3' 'all-in-one-platform'
		'animation_on' => true,
	);

	// Use array_merge to set any unset args to desired defaults
	$args = array_merge($default_args, $args);

	$selected_svg = $args['svg'];
	$modifier_class = $args['modifier_class'];
	$animation_on = $args['animation_on'];

	$slug = 'template-parts/svg/inline';
	$u_id = '_svg_'.new_unique_id();

?>
<div class="<?php echo $prefix . ' ' . $modifier_class; ?>">

	<?php
		if('dot-circle' === $selected_svg):
			get_template_part($slug, 'green-blue-dot-circle.svg', array('classname'=> $u_id.' light-gray' ));
		endif;
	?>

	<?php
		if('dot-wave' === $selected_svg):
			get_template_part($slug, 'green-dot-wave.svg', array('classname'=> $u_id.' light-gray'));
		endif;
	?>

	<?php
		// if('dot-wave-2' === $selected_svg):
		// 	get_template_part($slug, 'green-dot-wave-2.svg', array('classname'=> $u_id.' light-gray'));
			?>
				<script>
					// jQuery( document ).ready(function() {
					// 	// pop_dot_wave_2<?=$u_id?>();
					// 	setInterval(pop_dot_wave_2<?=$u_id?>, 7000);
					// });
				</script>
			<?php
		// endif;
	?>

	<?php
		if('dot-wave-3' === $selected_svg):
			get_template_part($slug, 'green-dot-wave-3.svg', array('classname'=> $u_id.' light-gray'));
		endif;
	?>

	<?php
		if('all-in-one-platform' === $selected_svg):
			get_template_part($slug, 'all-in-one-platform.svg', array('classname'=> $u_id));
		endif;
	?>


<?php if($animation_on): ?>


<script>

	function svg_add_path_classnames<?=$u_id?>( args = { svg_target_class:'', path_target_classes: [], classname: '', remove_only: false, cleanup_callback: null, interval: 0, recall_function: false } ) {
		// console.log('svg_add_path_classes', args);

		// build array of the target path elements
		let path_targets = [];

		if(window['svg_add_path_classes_args<?=$u_id?>'] && window['svg_add_path_classes_args<?=$u_id?>'].path_targets) {
			// we have the element collection already
			path_targets = window['svg_add_path_classes_args<?=$u_id?>'].path_targets;
			// console.log('<?=$u_id?> using existing path_targets:', args.svg_target_class, ' remove_only:', args.remove_only);
		} else {
			// build the element collection
			let svg = document.getElementsByClassName(args.svg_target_class)[0];
			if( undefined === svg ) {
				console.warn('Not found: svg_target_class',args.svg_target_class);
				return;
			}

			for(let i=0; i < args.path_target_classes.length; i++) {
				if( typeof args.path_target_classes[i] === 'string' ) { // classname given
					if('timeout' === args.path_target_classes[i]) path_target = document.getElementsByClassName('timeout')[0];
					else path_target = svg.getElementsByClassName(args.path_target_classes[i])[0];
				}
				else { // element given
					path_target = args.path_target_classes[i];
				}

				if( undefined === path_target ) {
					console.warn('Not found: path_target',i,path_target,args);
					continue;
				}

				path_targets.push(path_target);

			}
		}

		if(args.remove_only) {
			for(let i=0; i < path_targets.length; i++) {
				path_targets[i].classList.remove(args.classname);
			}
			return;
		}
		// console.log('document.hidden', document.hidden);
		if(document.hidden) {
			// console.log('document.hidden ACTION');
			clearInterval(window['svg_add_path_classes_interval<?=$u_id?>']);
			setTimeout(function(){
				window['svg_add_path_classes_cleanup_callback<?=$u_id?>']();
			}, 1000);
			window['svg_add_path_classes_running<?=$u_id?>'] = false;
			if(window['svg_add_path_classes_args<?=$u_id?>']['recall_function']) {
				// console.log('recall_function');
				setTimeout(function(){window['svg_add_path_classes_args<?=$u_id?>']['recall_function']()}, 1300);
			}
			else {
				console.log('no recall_function');
			}
			return;
		}
		if(window['svg_add_path_classes_running<?=$u_id?>'] === true) {
			console.warn('svg_add_path_classes_running<?=$u_id?> is still running! Adjust interval settings!');
			return;
		}

		window['svg_add_path_classes_args<?=$u_id?>'] = {
			i: 0,
			path_targets,
			classname: args.classname,
			how_many: (args.how_many) ? args.how_many : 1,
			recall_function : args.recall_function,
		}
		window['svg_add_path_classes_cleanup_callback<?=$u_id?>'] = args.cleanup_callback;
		window['svg_add_path_classes_running<?=$u_id?>'] = true;

		window['svg_add_path_classes_interval<?=$u_id?>'] = setInterval(function() {

			if(window['svg_add_path_classes_running<?=$u_id?>'] === false) return; // we're already done

			let i = window['svg_add_path_classes_args<?=$u_id?>']['i'];
			let args = window['svg_add_path_classes_args<?=$u_id?>'];
			window['svg_add_path_classes_args<?=$u_id?>']['i'] = i + args['how_many']; // iterate now, to avoid race condition for next interval
			let classname = window['svg_add_path_classes_args<?=$u_id?>']['classname'];

			for(let count = 0; count < args['how_many']; count++) {

				let path_target = args['path_targets'][i+count];

				if(i+count > args['path_targets'].length ) return; // a short interval setInterval can overrun the length


				if(i+count < args['path_targets'].length) {
						if( undefined === path_target ) {
							// console.warn('Not found: path_target', path_target, i, args['path_targets'].length, args['path_targets']);
							window['svg_add_path_classes_running<?=$u_id?>'] = false;
							return;
						}
						// if(window['svg_add_path_classes_args<?=$u_id?>']['recall_function']) {
						// 	console.log((path_target.className.baseVal) ? path_target.className.baseVal : path_target.className);
						// }
						path_target.classList.add(classname);
				} else {
					clearInterval(window['svg_add_path_classes_interval<?=$u_id?>']);
					setTimeout(function(){
						window['svg_add_path_classes_cleanup_callback<?=$u_id?>']();
					}, 1000);
					window['svg_add_path_classes_running<?=$u_id?>'] = false;
					if(window['svg_add_path_classes_args<?=$u_id?>']['recall_function']) {
						// console.log('recall_function');
						setTimeout(function(){window['svg_add_path_classes_args<?=$u_id?>']['recall_function']()}, 1300);
					}
				}

			}

		},
		args.interval);
	}


	<?php if('dot-wave' === $selected_svg): ?>

		jQuery( document ).ready(function() {
			pop_dot_wave<?=$u_id?>(20000);
		});

		function pop_dot_wave<?=$u_id?>(set_interval = 0) {
			// console.log('pop_dot_wave<?=$u_id?> at', set_interval);
			// if(document.hidden) return;
			let svg_target_class = '<?=$u_id?>';
			// let path_target_classes = [
			// 	'cls-1443','cls-1458','cls-1483','cls-1480','cls-1482','cls-1433','cls-1481','cls-1432','cls-1431','cls-1487','cls-1485','cls-1486','cls-1453',
			// 	'cls-1454','cls-1451','cls-1452','cls-1455','cls-1456','cls-1468','cls-1470','cls-1462','cls-1463','cls-1497','cls-1496','cls-1492','cls-1495',
			// 	'cls-1494','cls-1493','cls-1508','cls-1507','cls-1510','cls-1509','cls-1529','cls-1530','cls-1518','cls-1519','cls-1516','cls-1517','cls-1514',
			// 	'cls-1515','cls-1512','cls-1513','cls-1469','cls-1466','cls-1471','cls-1465','cls-1464','cls-1467','cls-1449','cls-1461','cls-1459','cls-1460',
			// 	'cls-1526','cls-1522','cls-1521','cls-1520','cls-1523','cls-1528','cls-1525','cls-1524','cls-1511','cls-1527','cls-1478','cls-1489','cls-1488',
			// 	'cls-1491','cls-1490','cls-1475','cls-1474','cls-1477','cls-1476','cls-1479','cls-1484','cls-1499','cls-1500','cls-1501','cls-1498','cls-1503',
			// 	'cls-1504','cls-1506','cls-1502','cls-1505','cls-1824','cls-1823','cls-1827','cls-1829','cls-1821','cls-1822','cls-1830','cls-1828','cls-1826',
			// 	'cls-1825','cls-1820','cls-1819','cls-1766','cls-1768','cls-1793','cls-1794','cls-1769','cls-1770','cls-1767','cls-1765','cls-1796','cls-1764',
			// 	'cls-1763','cls-1759','cls-1756','cls-1758','cls-1760','cls-1757','cls-1761','cls-1755','cls-1754','cls-1762','cls-1753','cls-1751','cls-1752',
			// 	'cls-1817','cls-1816','cls-1814','cls-1815','cls-1818','cls-1681','cls-1682','cls-1683','cls-1684','cls-1685','cls-1690','cls-1686','cls-1688',
			// 	'cls-1687',

			// 	"cls-1011", "cls-1001", "cls-1002", "cls-1003", "cls-1012", "cls-1013", "cls-1092", "cls-1091", "cls-1094", "cls-1095", "cls-1096", "cls-1078",
			// 	"cls-1076", "cls-1080", "cls-1079", "cls-1081", "cls-1430", "cls-1427", "cls-1424", "cls-1426", "cls-1425", "cls-1428", "cls-1429", "cls-1422",
			// 	"cls-1423", "cls-1421", "cls-1362", "cls-1361", "cls-1359", "cls-1363", "cls-1369", "cls-1367", "cls-1360", "cls-1368", "cls-1355", "cls-1354",
			// 	"cls-1351", "cls-1350", "cls-1349", "cls-1357", "cls-1353", "cls-1356", "cls-1352", "cls-1348", "cls-1358", "cls-1347", "cls-1346", "cls-1345",
			// 	"cls-1344", "cls-1343", "cls-1342", "cls-1341", "cls-1395", "cls-1394", "cls-1393", "cls-1392", "cls-1382", "cls-1383", "cls-1384", "cls-1385",
			// 	"cls-1386", "cls-1387", "cls-1388", "cls-1389", "cls-1390", "cls-1391", "cls-1413", "cls-1412", "cls-1414", "cls-1411", "cls-1416", "cls-1415",
			// 	"cls-1418", "cls-1417", "cls-1420", "cls-1419", "cls-1400", "cls-1401", "cls-1405", "cls-1406", "cls-1403", "cls-1404", "cls-1409", "cls-1410",
			// 	"cls-1408", "cls-1407", "cls-1402", "cls-1399", "cls-1397", "cls-1398", "cls-1396", "cls-1381", "cls-1380", "cls-1379", "cls-1376", "cls-1378",
			// 	"cls-1371", "cls-1374", "cls-1373", "cls-1377", "cls-1375", "cls-1370", "cls-1364", "cls-1365", "cls-1366", "cls-1372", "cls-1340", "cls-1337",
			// 	"cls-1339", "cls-1338", "cls-1336", "cls-1334", "cls-1332", "cls-1331", "cls-1333", "cls-1335", "cls-1434", "cls-1441", "cls-1440", "cls-1437",
			// 	"cls-1436", "cls-1439", "cls-1438", "cls-1473", "cls-1472", "cls-1435", "cls-1450", "cls-1446", "cls-1442", "cls-1448", "cls-1445", "cls-1444",
			// 	"cls-1447",

			// 	"cls-1265", "cls-1261", "cls-1262", "cls-1260", "cls-1263", "cls-1270", "cls-1267", "cls-1269", "cls-1268", "cls-1314", "cls-1315", "cls-1316",
			// 	"cls-1317", "cls-1318", "cls-1319", "cls-1320", "cls-1321", "cls-1322", "cls-1323", "cls-1313", "cls-1247", "cls-1246", "cls-1249", "cls-1248",
			// 	"cls-1243", "cls-1239", "cls-1244", "cls-1245", "cls-1240", "cls-1312", "cls-1310", "cls-1311", "cls-1308", "cls-1309", "cls-1306", "cls-1307",
			// 	"cls-1304", "cls-1305", "cls-1303", "cls-1329", "cls-1302", "cls-1330", "cls-1301", "cls-1300", "cls-1326", "cls-1325", "cls-1324", "cls-1327",
			// 	"cls-1328", "cls-1058", "cls-1059", "cls-1097", "cls-1098", "cls-1053", "cls-1055", "cls-1056", "cls-1054", "cls-1100", "cls-1099", "cls-1066",
			// 	"cls-1063", "cls-1062", "cls-1069", "cls-1068", "cls-1065", "cls-1064", "cls-1061", "cls-1060", "cls-1067", "cls-1086", "cls-1088", "cls-1089",
			// 	"cls-1082", "cls-1087", "cls-1083", "cls-1084", "cls-1090", "cls-1093", "cls-1085", "cls-1029", "cls-1028", "cls-1027", "cls-1026", "cls-1025",
			// 	"cls-1024", "cls-1041", "cls-1049", "cls-1048", "cls-1047", "cls-1046", "cls-1045", "cls-1043", "cls-1040", "cls-1044", "cls-1042", "cls-1038",
			// 	"cls-1039", "cls-1077", "cls-1037", "cls-1072", "cls-1074", "cls-1073", "cls-1070", "cls-1075", "cls-1071", "cls-1057", "cls-1050", "cls-1051",
			// 	"cls-1052", "cls-1021", "cls-1023", "cls-1033", "cls-1036", "cls-1031", "cls-1032", "cls-1034", "cls-1030", "cls-1022", "cls-1035", "cls-1004",
			// 	"cls-1006", "cls-1007", "cls-1018", "cls-1005", "cls-1009", "cls-1008", "cls-1020", "cls-1010", "cls-1019", "cls-1017", "cls-1016", "cls-1015",


			// 	"cls-44", "cls-45", "cls-11", "cls-12", "cls-13", "cls-14", "cls-15", "cls-7", "cls-6", "cls-10", "cls-9", "cls-8", "cls-22", "cls-5", "cls-4",
			// 	"cls-24", "cls-3", "cls-29", "cls-30", "cls-23", "cls-28", "cls-21", "cls-52", "cls-27", "cls-16", "cls-25", "cls-26", "cls-51", "cls-50",
			// 	"cls-38", "cls-37", "cls-39", "cls-33", "cls-17", "cls-19", "cls-18", "cls-20", "cls-31", "cls-35", "cls-34", "cls-36", "cls-32", "cls-53",
			// 	"cls-62", "cls-64", "cls-70", "cls-72", "cls-71", "cls-55", "cls-65", "cls-63", "cls-54", "cls-91", "cls-90", "cls-87", "cls-86", "cls-57",
			// 	"cls-56", "cls-94", "cls-93", "cls-89", "cls-88", "cls-75", "cls-76", "cls-83", "cls-92", "cls-81", "cls-82", "cls-79", "cls-80", "cls-77",
			// 	"cls-78", "cls-99", "cls-98", "cls-85", "cls-84", "cls-95", "cls-101", "cls-97", "cls-96", "cls-100", "cls-102", "cls-1276", "cls-1280",
			// 	"cls-1277", "cls-1287", "cls-1288", "cls-1285", "cls-1286", "cls-1278", "cls-1279", "cls-1273", "cls-1299", "cls-1297", "cls-1296", "cls-1275",
			// 	"cls-1274", "cls-1272", "cls-1271", "cls-1295", "cls-1294", "cls-1298", "cls-1257", "cls-1255", "cls-1254", "cls-1258", "cls-1264", "cls-1266",
			// 	"cls-1256", "cls-1253", "cls-1251", "cls-1250", "cls-1293", "cls-1252", "cls-1289", "cls-1291", "cls-1290", "cls-1292", "cls-1281", "cls-1283",
			// 	"cls-1282", "cls-1284", "cls-1242", "cls-1241", "cls-1236", "cls-1235", "cls-1238", "cls-1237", "cls-1231", "cls-1232", "cls-1233", "cls-1234",
			// 	"cls-1259",

			// ];


			let path_target_classes = [];

			if(undefined !== window.pop_dot_wave_groups) {
				path_target_classes = window.pop_dot_wave_groups;
			}
			else {

				let group_1 = [
					'timeout', 'timeout', 'timeout', 'timeout', 'timeout', 'timeout', 'timeout', 'timeout', 'timeout', 'timeout', 'timeout', 'timeout', 'timeout', 'timeout', 'timeout', 'timeout',
					'cls-1443','cls-1458','cls-1483','cls-1480','cls-1482','cls-1433','cls-1481','cls-1432','cls-1431','cls-1487','cls-1485','cls-1486','cls-1453',
					'cls-1454','cls-1451','cls-1452','cls-1455','cls-1456','cls-1468','cls-1470','cls-1462','cls-1463','cls-1497','cls-1496','cls-1492','cls-1495',
					'cls-1494','cls-1493','cls-1508','cls-1507','cls-1510','cls-1509','cls-1529','cls-1530','cls-1518','cls-1519','cls-1516','cls-1517','cls-1514',
					'cls-1515','cls-1512','cls-1513','cls-1469','cls-1466','cls-1471','cls-1465','cls-1464','cls-1467','cls-1449','cls-1461','cls-1459','cls-1460',
					'cls-1526','cls-1522','cls-1521','cls-1520','cls-1523','cls-1528','cls-1525','cls-1524','cls-1511','cls-1527','cls-1478','cls-1489','cls-1488',
					'cls-1491','cls-1490','cls-1475','cls-1474','cls-1477','cls-1476','cls-1479','cls-1484','cls-1499','cls-1500','cls-1501','cls-1498','cls-1503',
					'cls-1504','cls-1506','cls-1502','cls-1505','cls-1824','cls-1823','cls-1827','cls-1829','cls-1821','cls-1822','cls-1830','cls-1828','cls-1826',
					'cls-1825','cls-1820','cls-1819','cls-1766','cls-1768','cls-1793','cls-1794','cls-1769','cls-1770','cls-1767','cls-1765','cls-1796','cls-1764',
					'cls-1763','cls-1759','cls-1756','cls-1758','cls-1760','cls-1757','cls-1761','cls-1755','cls-1754','cls-1762','cls-1753','cls-1751','cls-1752',
					'cls-1817','cls-1816','cls-1814','cls-1815','cls-1818','cls-1681','cls-1682','cls-1683','cls-1684','cls-1685','cls-1690','cls-1686','cls-1688',
					'cls-1687',
				]
				let group_2 = [
					'timeout', 'timeout', 'timeout', 'timeout', 'timeout', 'timeout', 'timeout', 'timeout', 'timeout', 'timeout', 'timeout',
					"cls-1011", "cls-1001", "cls-1002", "cls-1003", "cls-1012", "cls-1013", "cls-1092", "cls-1091", "cls-1094", "cls-1095", "cls-1096", "cls-1078",
					"cls-1076", "cls-1080", "cls-1079", "cls-1081", "cls-1430", "cls-1427", "cls-1424", "cls-1426", "cls-1425", "cls-1428", "cls-1429", "cls-1422",
					"cls-1423", "cls-1421", "cls-1362", "cls-1361", "cls-1359", "cls-1363", "cls-1369", "cls-1367", "cls-1360", "cls-1368", "cls-1355", "cls-1354",
					"cls-1351", "cls-1350", "cls-1349", "cls-1357", "cls-1353", "cls-1356", "cls-1352", "cls-1348", "cls-1358", "cls-1347", "cls-1346", "cls-1345",
					"cls-1344", "cls-1343", "cls-1342", "cls-1341", "cls-1395", "cls-1394", "cls-1393", "cls-1392", "cls-1382", "cls-1383", "cls-1384", "cls-1385",
					"cls-1386", "cls-1387", "cls-1388", "cls-1389", "cls-1390", "cls-1391", "cls-1413", "cls-1412", "cls-1414", "cls-1411", "cls-1416", "cls-1415",
					"cls-1418", "cls-1417", "cls-1420", "cls-1419", "cls-1400", "cls-1401", "cls-1405", "cls-1406", "cls-1403", "cls-1404", "cls-1409", "cls-1410",
					"cls-1408", "cls-1407", "cls-1402", "cls-1399", "cls-1397", "cls-1398", "cls-1396", "cls-1381", "cls-1380", "cls-1379", "cls-1376", "cls-1378",
					"cls-1371", "cls-1374", "cls-1373", "cls-1377", "cls-1375", "cls-1370", "cls-1364", "cls-1365", "cls-1366", "cls-1372", "cls-1340", "cls-1337",
					"cls-1339", "cls-1338", "cls-1336", "cls-1334", "cls-1332", "cls-1331", "cls-1333", "cls-1335", "cls-1434", "cls-1441", "cls-1440", "cls-1437",
					"cls-1436", "cls-1439", "cls-1438", "cls-1473", "cls-1472", "cls-1435", "cls-1450", "cls-1446", "cls-1442", "cls-1448", "cls-1445", "cls-1444",
					"cls-1447",
				]

				let group_3 = [
					'timeout', 'timeout', 'timeout', 'timeout', 'timeout', 'timeout', 'timeout',
					"cls-1265", "cls-1261", "cls-1262", "cls-1260", "cls-1263", "cls-1270", "cls-1267", "cls-1269", "cls-1268", "cls-1314", "cls-1315", "cls-1316",
					"cls-1317", "cls-1318", "cls-1319", "cls-1320", "cls-1321", "cls-1322", "cls-1323", "cls-1313", "cls-1247", "cls-1246", "cls-1249", "cls-1248",
					"cls-1243", "cls-1239", "cls-1244", "cls-1245", "cls-1240", "cls-1312", "cls-1310", "cls-1311", "cls-1308", "cls-1309", "cls-1306", "cls-1307",
					"cls-1304", "cls-1305", "cls-1303", "cls-1329", "cls-1302", "cls-1330", "cls-1301", "cls-1300", "cls-1326", "cls-1325", "cls-1324", "cls-1327",
					"cls-1328", "cls-1058", "cls-1059", "cls-1097", "cls-1098", "cls-1053", "cls-1055", "cls-1056", "cls-1054", "cls-1100", "cls-1099", "cls-1066",
					"cls-1063", "cls-1062", "cls-1069", "cls-1068", "cls-1065", "cls-1064", "cls-1061", "cls-1060", "cls-1067", "cls-1086", "cls-1088", "cls-1089",
					"cls-1082", "cls-1087", "cls-1083", "cls-1084", "cls-1090", "cls-1093", "cls-1085", "cls-1029", "cls-1028", "cls-1027", "cls-1026", "cls-1025",
					"cls-1024", "cls-1041", "cls-1049", "cls-1048", "cls-1047", "cls-1046", "cls-1045", "cls-1043", "cls-1040", "cls-1044", "cls-1042", "cls-1038",
					"cls-1039", "cls-1077", "cls-1037", "cls-1072", "cls-1074", "cls-1073", "cls-1070", "cls-1075", "cls-1071", "cls-1057", "cls-1050", "cls-1051",
					"cls-1052", "cls-1021", "cls-1023", "cls-1033", "cls-1036", "cls-1031", "cls-1032", "cls-1034", "cls-1030", "cls-1022", "cls-1035", "cls-1004",
					"cls-1006", "cls-1007", "cls-1018", "cls-1005", "cls-1009", "cls-1008", "cls-1020", "cls-1010", "cls-1019", "cls-1017", "cls-1016", "cls-1015",
				]

				let group_4 = [
					'timeout', 'timeout',
					"cls-44", "cls-45", "cls-11", "cls-12", "cls-13", "cls-14", "cls-15", "cls-7", "cls-6", "cls-10", "cls-9", "cls-8", "cls-22", "cls-5", "cls-4",
					"cls-24", "cls-3", "cls-29", "cls-30", "cls-23", "cls-28", "cls-21", "cls-52", "cls-27", "cls-16", "cls-25", "cls-26", "cls-51", "cls-50",
					"cls-38", "cls-37", "cls-39", "cls-33", "cls-17", "cls-19", "cls-18", "cls-20", "cls-31", "cls-35", "cls-34", "cls-36", "cls-32", "cls-53",
					"cls-62", "cls-64", "cls-70", "cls-72", "cls-71", "cls-55", "cls-65", "cls-63", "cls-54", "cls-91", "cls-90", "cls-87", "cls-86", "cls-57",
					"cls-56", "cls-94", "cls-93", "cls-89", "cls-88", "cls-75", "cls-76", "cls-83", "cls-92", "cls-81", "cls-82", "cls-79", "cls-80", "cls-77",
					"cls-78", "cls-99", "cls-98", "cls-85", "cls-84", "cls-95", "cls-101", "cls-97", "cls-96", "cls-100", "cls-102", "cls-1276", "cls-1280",
					"cls-1277", "cls-1287", "cls-1288", "cls-1285", "cls-1286", "cls-1278", "cls-1279", "cls-1273", "cls-1299", "cls-1297", "cls-1296", "cls-1275",
					"cls-1274", "cls-1272", "cls-1271", "cls-1295", "cls-1294", "cls-1298", "cls-1257", "cls-1255", "cls-1254", "cls-1258", "cls-1264", "cls-1266",
					"cls-1256", "cls-1253", "cls-1251", "cls-1250", "cls-1293", "cls-1252", "cls-1289", "cls-1291", "cls-1290", "cls-1292", "cls-1281", "cls-1283",
					"cls-1282", "cls-1284", "cls-1242", "cls-1241", "cls-1236", "cls-1235", "cls-1238", "cls-1237", "cls-1231", "cls-1232", "cls-1233", "cls-1234",
					"cls-1259",
				]

				// let group_5 = [
				// 	'cls-22','cls-17','cls-24','cls-3','cls-5','cls-128','cls-129','cls-131','cls-126','cls-127','cls-105','cls-123',
				// 	'cls-125','cls-114','cls-119','cls-116','cls-103','cls-99','cls-98','cls-102','cls-113','cls-111','cls-110',
				// ]

				// let groups = [ group_1, group_2, group_3, group_4, group_5 ]

				let done = false;
				for(let i=0; !done; i++) {

					if (i > 999) {done = true; continue;}

					if(group_1[i] || group_2[i] || group_3[i] || group_4[i]) {

						if(group_1[i]) path_target_classes.push(group_1[i]);
						if(group_2[i]) path_target_classes.push(group_2[i]);
						if(group_3[i]) path_target_classes.push(group_3[i]);
						if(group_4[i]) path_target_classes.push(group_4[i]);
						// if(group_5[i]) path_target_classes.push(group_5[i]);

					}
					else {done = true;}
				}

				window.pop_dot_wave_groups = path_target_classes;

			}


			let classname = 'pop';

			window['pop_dot_wave_args<?=$u_id?>'] = {
				svg_target_class,
				path_target_classes,
				classname,
				remove_only: true,
				cleanup_callback: null,
				interval: 0,
			}

			window['pop_dot_wave_args_callback<?=$u_id?>'] = function() {
				svg_add_path_classnames<?=$u_id?>(window['pop_dot_wave_args<?=$u_id?>']);
			}

			let args = {
				svg_target_class,
				path_target_classes,
				classname,
				remove_only: false,
				cleanup_callback: window['pop_dot_wave_args_callback<?=$u_id?>'],
				interval: 50,
				how_many: 4,
				recall_function: pop_dot_wave<?=$u_id?>,
			}

			svg_add_path_classnames<?=$u_id?>( args );

			// if(set_interval > 0) setInterval(pop_dot_wave<?=$u_id?>, set_interval);


		}
	<?php endif; // 'dot-wave' ?>


	<?php if('dot-wave-3' === $selected_svg): ?>

		jQuery( document ).ready(function() {
			pop_dot_wave_3<?=$u_id?>(24000);
		});

		function pop_dot_wave_3<?=$u_id?>(set_interval = 0) {
			// console.log('pop_dot_wave_3<?=$u_id?> at', set_interval);
			// if(document.hidden) return;
			let svg_target_class = '<?=$u_id?>';
			let path_target_classes = [];

			if(undefined !== window.pop_dot_wave_3_groups) {
				path_target_classes = window.pop_dot_wave_3_groups;
			}
			else {

				let group_1 = ['cls-1823', 'cls-1961', 'cls-1375', 'cls-1219', 'cls-1624', 'cls-11023', 'cls-11154', 'cls-1722', 'cls-1454', 'cls-1553',
					'cls-1866', 'cls-1873', 'cls-1907', 'cls-11064', 'cls-11211', 'cls-1875', 'cls-11029', 'cls-11375', 'cls-11519', 'cls-11798', 'cls-12148', 'cls-12029',
					'cls-11927', 'cls-11615', 'cls-11641', 'cls-12149',
					'timeout', 'timeout', 'timeout', 'timeout', 'timeout', 'timeout', 'timeout', 'timeout',
					'cls-11674', 'cls-11190', 'cls-11255', 'cls-11480', 'cls-11492', 'cls-11865', 'cls-11966', 'cls-11743',
					'cls-11593', 'cls-11799', 'cls-11909', 'cls-11499', 'cls-11565', 'cls-12086', 'cls-12435', 'cls-12239', 'cls-11962', 'cls-11658', 'cls-11330', 'cls-11270',
					'cls-11087', 'cls-11235', 'cls-11325',
					'timeout', 'timeout', 'timeout', 'timeout', 'timeout','timeout', 'timeout', 'timeout', 'timeout', 'timeout', 'timeout', 'timeout',
					'timeout', 'timeout', 'timeout', 'timeout', 'timeout','timeout', 'timeout', 'timeout', 'timeout', 'timeout', 'timeout', 'timeout',
					'cls-1956', 'cls-11486', 'cls-11914', 'cls-12075', 'cls-12094', 'cls-12190', 'cls-12318', 'cls-12252', 'cls-12115',
					'cls-11812', 'cls-11103', 'cls-11648', 'cls-12320', 'cls-13781',
				];

				// let group_2 = [
				// 	'cls-13849', 'cls-11611', 'cls-11084', 'cls-11400', 'cls-11852', 'cls-11762', 'cls-11406', 'cls-11583', 'cls-11695', 'cls-11382', 'cls-11410', 'cls-11195',
				// 	'cls-11351', 'cls-11617', 'cls-11844', 'cls-12095',
				// 	'timeout', 'timeout', 'timeout', 'timeout', 'timeout', 'timeout', 'timeout', 'timeout','timeout', 'timeout', 'timeout', 'timeout', 'timeout', 'timeout', 'timeout',
				// 'timeout',
				// 	'cls-11897', 'cls-11873', 'cls-12124', 'cls-12220', 'cls-11951', 'cls-11385', 'cls-11396', 'cls-11071', 'cls-1879', 'cls-11518', 'cls-11301', 'cls-11169',
				// 	'cls-11675', 'cls-11774', 'cls-11275', 'cls-1796', 'cls-1973', 'cls-11075', 'cls-1910', 'cls-1625', 'cls-1572', 'cls-1447', 'cls-1354', 'cls-1392',
				// 	'cls-1947', 'cls-11807', 'cls-12821', 'cls-13737', 'cls-13771', 'cls-13782', 'cls-13981',
				// ];
				let group_2 = [

					"timeout", "timeout", "timeout", "timeout", "timeout","timeout", "timeout", "timeout", "timeout",

					"cls-12095", "cls-11844", "cls-11617", "cls-11351", "cls-11195", "cls-11410", "cls-11382", "cls-11695", "cls-11583", "cls-11406", "cls-11762", "cls-11852", "cls-11400",
				 	"cls-11084", "cls-11611", "cls-13849",

					"cls-13396", "cls-12542", "cls-12158", "cls-12507", "cls-13244", "cls-13508", "cls-13296",
					"cls-13509", "cls-13246", "cls-12950", "cls-12819", "cls-12686", "cls-12969", "cls-13052", "cls-13037", "cls-13108", "cls-13406", "cls-13993",

					"timeout", "timeout", "timeout", "timeout",

					// "timeout", "timeout", "timeout", "timeout", "timeout",

					"cls-13393", "cls-12586", "cls-11975", "cls-12269", "cls-12980", "cls-13505", "cls-13089", "cls-12630", "cls-12407", "cls-12302", "cls-12111", "cls-12195", "cls-11976",
					"cls-12311", "cls-13005", "cls-13477", "cls-13172", "cls-13491", "cls-13299", "cls-13513", "cls-13250", "cls-13778", "cls-13131", "cls-13176", "cls-12983", "cls-13051",
					"cls-13163", "cls-13853", "cls-14149", "cls-13557", "cls-13413", "cls-13414", "cls-13419", "cls-13616", "cls-14181", "cls-14187",

					"timeout", "timeout", "timeout", "timeout",

					"cls-13981","cls-13782","cls-13771","cls-13737","cls-12821", "cls-11807", "cls-1947", "cls-1392", "cls-1354", "cls-1447", "cls-1572", "cls-1625", "cls-1910", "cls-11075",
					"cls-1973", "cls-1796", "cls-11275", "cls-11774", "cls-11675", "cls-11169", "cls-11301", "cls-11518", "cls-1879", "cls-11071", "cls-11396", "cls-11385", "cls-11951",
					"cls-12220", "cls-12124", "cls-11873", "cls-11897",


				]


				let done = false;
				for(let i=0; !done; i++) {

					if (i > 999) {done = true; continue;}

					if(group_1[i] || group_2[i]) {

						if(group_1[i]) path_target_classes.push(group_1[i]);
						else path_target_classes.push('timeout');

						if(group_2[i]) path_target_classes.push(group_2[i]);
						else path_target_classes.push('timeout');

					}
					else {done = true;}
				}


				 window.pop_dot_wave_3_groups = path_target_classes;

			}

			let classname = 'pop';

			window['pop_dot_wave_3_args<?=$u_id?>'] = {
				svg_target_class,
				path_target_classes,
				classname,
				remove_only: true,
				cleanup_callback: null,
				interval: 0,
			}

			window['pop_dot_wave_3_args_callback<?=$u_id?>'] = function() {
				svg_add_path_classnames<?=$u_id?>(window['pop_dot_wave_3_args<?=$u_id?>']);
			}

			let args = {
				svg_target_class,
				path_target_classes,
				classname,
				remove_only: false,
				cleanup_callback: window['pop_dot_wave_3_args_callback<?=$u_id?>'],
				interval: 150,
				how_many: 2,
				recall_function: pop_dot_wave_3<?=$u_id?>,
			}

			svg_add_path_classnames<?=$u_id?>( args );

			// if(set_interval > 0) setInterval(pop_dot_wave_3<?=$u_id?>, set_interval);

		}
	<?php endif; // 'dot-wave-3' ?>

	<?php if('dot-circle' === $selected_svg): ?>

		jQuery( document ).ready(function() {
			pop_dot_circle<?=$u_id?>(12000);
		});

		function pop_dot_circle<?=$u_id?>(set_interval = 0) {
			// console.log('pop_dot_circle<?=$u_id?> at', set_interval);
			// if(document.hidden) return;
			let svg_target_class = '<?=$u_id?>';
			//  let path_target_classes = [
			// 	'cls-96','cls-66','cls-71','cls-72','cls-73','cls-69','cls-82','cls-93','cls-76','cls-81','cls-92','cls-20',
			// 	'cls-16','cls-55','cls-54','cls-60','cls-58','cls-53','cls-90','cls-91','cls-87','cls-89','cls-83',
			// 	'timeout', 'timeout', 'timeout', 'timeout', 'timeout','timeout', 'timeout', 'timeout',

			// 	'cls-15','cls-12','cls-13','cls-8','cls-9','cls-30','cls-62','cls-64','cls-47','cls-65','cls-26','cls-177',
			// 	'cls-175','cls-171','cls-50','cls-43','cls-41','cls-37','cls-40','cls-31','cls-28','cls-33','cls-35',
			// 	'timeout', 'timeout', 'timeout', 'timeout', 'timeout','timeout', 'timeout', 'timeout',

			// 	'cls-157','cls-163','cls-161','cls-166','cls-164','cls-169','cls-168','cls-143','cls-145','cls-147','cls-149','cls-150',
			// 	'cls-200','cls-159','cls-154','cls-156','cls-152','cls-182','cls-190','cls-188','cls-186','cls-183','cls-180','cls-178',
			// 	'timeout', 'timeout', 'timeout', 'timeout', 'timeout','timeout', 'timeout', 'timeout',

			// 	'cls-216','cls-203','cls-204','cls-202','cls-209','cls-201','cls-212','cls-213','cls-133','cls-138','cls-136','cls-137',
			// 	'cls-217','cls-225','cls-228','cls-229','cls-221','cls-223','cls-218','cls-192','cls-194','cls-197','cls-196',
			// 	'timeout', 'timeout', 'timeout', 'timeout', 'timeout','timeout', 'timeout', 'timeout',

			// 	'cls-22','cls-17','cls-24','cls-3','cls-5','cls-128','cls-129','cls-131','cls-126','cls-127','cls-105','cls-123',
			// 	'cls-125','cls-114','cls-119','cls-116','cls-103','cls-99','cls-98','cls-102','cls-113','cls-111','cls-110',
			// ];

			let path_target_classes = [];

			if(undefined !== window.pop_dot_circle_groups) {
				path_target_classes = window.pop_dot_circle_groups
			}
			else {

				let group_1 = [
					'timeout','timeout','timeout','timeout','timeout','timeout','timeout','timeout','timeout','timeout','timeout','timeout','timeout','timeout','timeout','timeout','timeout','timeout','timeout','timeout',
					'cls-96','cls-66','cls-71','cls-72','cls-73','cls-69','cls-82','cls-93','cls-76','cls-81','cls-92','cls-20',
					'cls-16','cls-55','cls-54','cls-60','cls-58','cls-53','cls-90','cls-91','cls-87','cls-89','cls-83',
				]
				let group_2 = [
					'timeout','timeout','timeout','timeout','timeout','timeout','timeout','timeout','timeout','timeout','timeout','timeout','timeout','timeout','timeout',
					'cls-15','cls-12','cls-13','cls-8','cls-9','cls-30','cls-62','cls-64','cls-47','cls-65','cls-26','cls-177',
					'cls-175','cls-171','cls-50','cls-43','cls-41','cls-37','cls-40','cls-31','cls-28','cls-33','cls-35',
				]

				let group_3 = [
					'timeout','timeout','timeout','timeout','timeout','timeout','timeout','timeout','timeout','timeout',
					'cls-157','cls-163','cls-161','cls-166','cls-164','cls-169','cls-168','cls-143','cls-145','cls-147','cls-149','cls-150',
					'cls-200','cls-159','cls-154','cls-156','cls-152','cls-182','cls-190','cls-188','cls-186','cls-183','cls-180','cls-178',
				]

				let group_4 = [
					'timeout','timeout','timeout','timeout','timeout',
					'cls-216','cls-203','cls-204','cls-202','cls-209','cls-201','cls-212','cls-213','cls-133','cls-138','cls-136','cls-137',
					'cls-217','cls-225','cls-228','cls-229','cls-221','cls-223','cls-218','cls-192','cls-194','cls-197','cls-196',
				]

				let group_5 = [
					'cls-22','cls-17','cls-24','cls-3','cls-5','cls-128','cls-129','cls-131','cls-126','cls-127','cls-105','cls-123',
					'cls-125','cls-114','cls-119','cls-116','cls-103','cls-99','cls-98','cls-102','cls-113','cls-111','cls-110',
				]

				// let groups = [ group_1, group_2, group_3, group_4, group_5 ]

				let done = false;
				for(let i=0; !done; i++) {

					if (i > 999) {done = true; continue;}

					if(group_1[i] || group_2[i] || group_3[i] || group_4[i] || group_5[i]) {

						if(group_5[i]) path_target_classes.push(group_5[i]);
						if(group_4[i]) path_target_classes.push(group_4[i]);
						if(group_3[i]) path_target_classes.push(group_3[i]);
						if(group_2[i]) path_target_classes.push(group_2[i]);
						if(group_1[i]) path_target_classes.push(group_1[i]);

					}
					else {done = true;}
				}

				window.pop_dot_circle_groups = path_target_classes;
			}


			let classname = 'pop';

			window['pop_dot_circle_args<?=$u_id?>'] = {
				svg_target_class,
				path_target_classes,
				classname,
				remove_only: true,
				cleanup_callback: null,
				interval: 0,
			}

			window['pop_dot_circle_args_callback<?=$u_id?>'] = function() {
				svg_add_path_classnames<?=$u_id?>(window['pop_dot_circle_args<?=$u_id?>']);
			}

			args = {
				svg_target_class,
				path_target_classes,
				classname,
				remove_only: false,
				cleanup_callback: window['pop_dot_circle_args_callback<?=$u_id?>'],
				interval: 100,
				set_interval,
				how_many: 5,
				recall_function: pop_dot_circle<?=$u_id?>,
			}
			svg_add_path_classnames<?=$u_id?>( args );

			// if(set_interval > 0) setInterval(pop_dot_circle<?=$u_id?>, set_interval);

		}
	<?php endif; // 'dot-circle' ?>

	<?php if('all-in-one-platform' === $selected_svg): ?>

		jQuery( document ).ready(function() {
			all_in_one<?=$u_id?>();
		});

		function all_in_one<?=$u_id?>(set_interval = 0) {
			// console.log('all_in_one<?=$u_id?> at', set_interval);
			// if(document.hidden) return;
			let svg_target_class = '<?=$u_id?>';

			let path_target_classes = [
				'cls-3',
				'cls-9','cls-4','cls-10','cls-6',
				'timeout','cls-12','timeout',
				'cls-7','cls-11','cls-5','cls-8',
			];

			if(undefined !== window.all_in_one_groups) {
				path_target_classes = window.all_in_one_groups
			}
			else {

				window.all_in_one_groups = path_target_classes;
			}


			let classname = 'pop-up';

			window['all_in_one_args<?=$u_id?>'] = {
				svg_target_class,
				path_target_classes,
				classname,
				remove_only: true,
				cleanup_callback: null,
				interval: 0,
			}

			window['all_in_one_args_callback<?=$u_id?>'] = function() {
				svg_add_path_classnames<?=$u_id?>(window['all_in_one_args<?=$u_id?>']);
			}

			args = {
				svg_target_class,
				path_target_classes,
				classname,
				remove_only: false,
				cleanup_callback: window['all_in_one_args_callback<?=$u_id?>'],
				interval: 700,
				set_interval,
				how_many: 1,
				recall_function: all_in_one<?=$u_id?>,
			}
			svg_add_path_classnames<?=$u_id?>( args );

		}
	<?php endif; // 'all-in-one-platform' ?>
</script>

	<span class="timeout" style="display: none;"></span>

<?php endif; // $animation_on ?>

</div>
<!-- end : repay/app/public/wp-content/themes/repay/template-parts/svg-animation.php -->