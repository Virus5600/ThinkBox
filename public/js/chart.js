/**
 * Creates a line chart based on the following parameters:
 * @param target id of the target canvas where the chart will be drawn.
 * @param labels The labels that are displayed on bottom of the chart.
 * @param dataset The dataset that will be displayed as line chart.
 * @param displayTitle Determines if a title will be displayed. Default value is false.
 * @param title The title to display for the line chart.
 * @param fontSize The font size for the title of the chart. Default value is 25.
 * @param fontWeight The font weight of the title of the chart. Default is 'normal'. See https://developer.mozilla.org/en-US/docs/Web/CSS/font-weight for more details
 */
function createLineChart(target, labels, dataset, displayTitle=false, title='', fontSize=25, fontWeight='normal') {
	return new Chart(target, {
		type: 'line',
		data: {
			labels: labels,
			datasets: dataset
		},
		options: {
			plugins: {
				title: {
					display: displayTitle,
					text: title,
					font: {
						size: fontSize,
						weight: fontWeight,
					}
				},
				legend: {
					position: 'right',
					labels: {
						boxWidth: 10,
						boxHeight: 10
					}
				}
			}
		}
	});
}