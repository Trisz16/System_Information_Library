import "./bootstrap";
import Chart from "chart.js/auto";

import Alpine from "alpinejs";

window.Alpine = Alpine;

// Real-time clock functionality
function updateClock() {
    const now = new Date();
    const timeElement = document.getElementById("real-time-clock");
    const dateElement = document.getElementById("real-time-date");

    if (timeElement) {
        timeElement.textContent = now.toLocaleTimeString("id-ID", {
            hour12: false,
            hour: "2-digit",
            minute: "2-digit",
            second: "2-digit",
        });
    }

    if (dateElement) {
        dateElement.textContent = now.toLocaleDateString("id-ID", {
            weekday: "long",
            year: "numeric",
            month: "long",
            day: "numeric",
        });
    }
}

// Initialize dashboard charts
function initializeCharts() {
    // Monthly Loan Trends Chart
    const loanTrendsCtx = document.getElementById("loanTrendsChart");
    if (loanTrendsCtx && window.monthlyLoansData) {
        new Chart(loanTrendsCtx, {
            type: "line",
            data: {
                labels: window.monthlyLoansData.map((item) => item.month),
                datasets: [
                    {
                        label: "Jumlah Peminjaman",
                        data: window.monthlyLoansData.map((item) => item.count),
                        borderColor: "#c8853d",
                        backgroundColor: "rgba(200, 133, 61, 0.1)",
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: "#c8853d",
                        pointBorderColor: "#fff",
                        pointBorderWidth: 2,
                        pointRadius: 6,
                        pointHoverRadius: 8,
                        pointHoverBackgroundColor: "#b87332",
                        pointHoverBorderColor: "#fff",
                        pointHoverBorderWidth: 3,
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    },
                    tooltip: {
                        backgroundColor: "rgba(0, 0, 0, 0.8)",
                        titleColor: "#fff",
                        bodyColor: "#fff",
                        cornerRadius: 8,
                        displayColors: false,
                    },
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            color: "rgba(200, 133, 61, 0.1)",
                        },
                        ticks: {
                            color: "#64748b",
                        },
                    },
                    x: {
                        grid: {
                            color: "rgba(200, 133, 61, 0.1)",
                        },
                        ticks: {
                            color: "#64748b",
                        },
                    },
                },
                animation: {
                    duration: 2000,
                    easing: "easeInOutQuart",
                },
            },
        });
    }

    // Category Distribution Chart
    const categoryCtx = document.getElementById("categoryChart");
    if (categoryCtx && window.categoryData) {
        new Chart(categoryCtx, {
            type: "doughnut",
            data: {
                labels: window.categoryData.map((item) => item.name),
                datasets: [
                    {
                        data: window.categoryData.map((item) => item.count),
                        backgroundColor: [
                            "#c8853d",
                            "#b87332",
                            "#a16207",
                            "#854d0e",
                            "#713f12",
                            "#9a5c29",
                            "#7d4a24",
                            "#653d20",
                        ],
                        borderColor: "#fff",
                        borderWidth: 2,
                        hoverBorderWidth: 3,
                        hoverBorderColor: "#fff",
                    },
                ],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: "bottom",
                        labels: {
                            padding: 20,
                            usePointStyle: true,
                            color: "#64748b",
                        },
                    },
                    tooltip: {
                        backgroundColor: "rgba(0, 0, 0, 0.8)",
                        titleColor: "#fff",
                        bodyColor: "#fff",
                        cornerRadius: 8,
                        callbacks: {
                            label: function (context) {
                                const label = context.label || "";
                                const value = context.parsed || 0;
                                const percentage =
                                    window.categoryData[context.dataIndex]
                                        .percentage;
                                return `${label}: ${value} buku (${percentage}%)`;
                            },
                        },
                    },
                },
                animation: {
                    duration: 2000,
                    easing: "easeInOutQuart",
                    animateRotate: true,
                    animateScale: true,
                },
            },
        });
    }
}

// Initialize when DOM is loaded
document.addEventListener("DOMContentLoaded", function () {
    // Start real-time clock
    updateClock();
    setInterval(updateClock, 1000);

    // Initialize charts
    initializeCharts();
});

Alpine.start();
