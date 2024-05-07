$(document).ready(function() {

	// Bar Chart
	
	Morris.Bar({
		element: 'bar-charts',
		data: morrisData,
		// data: [
		// 	{ y: '2018', a: 0,  b: 0 },
		// 	{ y: '2019', a: 0,  b: 0 },
		// 	{ y: '2020', a: 0,  b: 0 },
		// 	{ y: '2021', a: 0,  b: 0 },
		// 	{ y: '2022', a: 0,  b: 0 },
		// 	{ y: '2023', a: 0,  b: 0 },
		// 	{ y: '2024', a: 0,  b: 0 }
		// ],

		xkey: 'y',
		ykeys: ['a', 'b'],
		labels: ['Total Employee', 'Total Designation'],
		lineColors: ['#ff9b44','#fc6075'],
		lineWidth: '3px',
		barColors: ['#ff9b44','#fc6075'],
		resize: true,
		redraw: true
	});
	
	// Line Chart
	
	Morris.Line({
		element: 'line-charts',
		data: [
			{ y: '2018', a: 0,  b: 0 },
			{ y: '2019', a: 0,  b:0 },
			{ y: '2020', a: 0,  b:0 },
			{ y: '2021', a: 0,  b:0 },
			{ y: '2022', a: 0,  b:0 },
			{ y: '2023', a: 0,  b:0 },
			{ y: '2024', a: 0,  b: 0 }
		],
		xkey: 'y',
		ykeys: ['a', 'b'],
		labels: ['Total Sales', 'Total Revenue'],
		lineColors: ['#ff9b44','#fc6075'],
		lineWidth: '3px',
		resize: true,
		redraw: true
	});
		
});


