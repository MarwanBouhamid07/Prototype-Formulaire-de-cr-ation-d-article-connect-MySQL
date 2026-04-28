// 1. Define the data for different periods (English comments as requested)
const chartData = {
    'this-month': {
        labels: ['1 Mar', '10 Mar', '20 Mar', '30 Mar'],
        data: [400, 1200, 2400, 3200]
    },
    'last-month': {
        labels: ['1 Feb', '10 Feb', '20 Feb', '28 Feb'],
        data: [800, 1500, 1100, 1900]
    },
    'this-year': {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
        data: [5000, 7000, 4500, 8500, 9000, 12000]
    }
};



// 3. Add Event Listener to the select dropdown
document.getElementById('timeFilter').addEventListener('change', function() {
    const selectedValue = this.value; // Get the value (this-month, etc.)
    
    // Update labels and data based on selection
    myChart.data.labels = chartData[selectedValue].labels;
    myChart.data.datasets[0].data = chartData[selectedValue].data;
    
    // Refresh the chart with a smooth animation
    myChart.update();
});

// Get the context of the canvas element
const ctx = document.getElementById('pageViewsChart').getContext('2d');

// Create a linear gradient for the "Area" fill
const gradient = ctx.createLinearGradient(0, 0, 0, 400);
gradient.addColorStop(0, 'rgba(59, 130, 246, 0.5)'); // Light blue at top
gradient.addColorStop(1, 'rgba(59, 130, 246, 0.0)'); // Transparent at bottom

const myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: chartData['this-month'].labels, // X-axis
        datasets: [{
            label: 'Page Views',
            data: chartData['this-month'].data, // Y-axis data
            borderColor: '#3b82f6', // Line color (Blue)
            borderWidth: 3,
            fill: true, // Enable the area fill
            backgroundColor: gradient, // Apply the gradient
            tension: 0.4, // This creates the smooth "curved" line
            pointRadius: 0, // Hides the dots on the line for a cleaner look
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { display: false } // Hide the legend like in your image
        },
        scales: {
            y: {
                beginAtZero: true,
                grid: { display: true, drawBorder: false, color: '#f1f5f9' }
            },
            x: {
                grid: { display: false }
            }
        }
    }
});

document.getElementById('timeFilter').addEventListener('change', function() {
    const selectedValue = this.value; // Get the value (this-month, etc.)
    
    // Update labels and data based on selection
    myChart.data.labels = chartData[selectedValue].labels;
    myChart.data.datasets[0].data = chartData[selectedValue].data;
    
    // Refresh the chart with a smooth animation
    myChart.update();
});