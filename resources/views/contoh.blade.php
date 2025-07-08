<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            color: #333;
        }

        .dashboard {
            display: grid;
            grid-template-columns: 250px 1fr;
            min-height: 100vh;
        }

        .sidebar {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-right: 1px solid rgba(255, 255, 255, 0.2);
            padding: 2rem 0;
        }

        .logo {
            text-align: center;
            padding: 1rem;
            color: white;
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 2rem;
        }

        .nav-menu {
            list-style: none;
        }

        .nav-item {
            padding: 0.75rem 1.5rem;
            color: rgba(255, 255, 255, 0.8);
            cursor: pointer;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }

        .nav-item:hover,
        .nav-item.active {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border-left-color: #4CAF50;
        }

        .nav-item i {
            margin-right: 0.5rem;
            width: 20px;
        }

        .main-content {
            padding: 2rem;
            overflow-y: auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 1rem 2rem;
            border-radius: 15px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .header h1 {
            color: white;
            font-size: 2rem;
        }

        .user-info {
            display: flex;
            align-items: center;
            color: white;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #4CAF50;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-left: 1rem;
            font-weight: bold;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 1.5rem;
            border-radius: 15px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            text-align: center;
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .stat-value {
            font-size: 2rem;
            font-weight: bold;
            color: white;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.9rem;
        }

        .content-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 2rem;
        }

        .card {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 2rem;
            border-radius: 15px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .card h3 {
            color: white;
            margin-bottom: 1rem;
            font-size: 1.3rem;
        }

        .chart-container {
            height: 300px;
            display: flex;
            align-items: end;
            justify-content: space-around;
            border-bottom: 2px solid rgba(255, 255, 255, 0.2);
            padding: 1rem 0;
        }

        .chart-bar {
            width: 40px;
            background: linear-gradient(45deg, #4CAF50, #45a049);
            border-radius: 5px 5px 0 0;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .chart-bar:hover {
            opacity: 0.8;
            transform: scale(1.05);
        }

        .recent-activity {
            color: rgba(255, 255, 255, 0.9);
        }

        .activity-item {
            padding: 1rem 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: #4CAF50;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            color: white;
        }

        .activity-text {
            flex: 1;
        }

        .activity-time {
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.8rem;
        }

        .btn {
            background: #4CAF50;
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 1rem;
        }

        .btn:hover {
            background: #45a049;
            transform: translateY(-2px);
        }

        @media (max-width: 768px) {
            .dashboard {
                grid-template-columns: 1fr;
            }
            
            .sidebar {
                display: none;
            }
            
            .content-grid {
                grid-template-columns: 1fr;
            }
            
            .stats-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <div class="dashboard">
        <div class="sidebar">
            <div class="logo">Laravel Dashboard</div>
            <ul class="nav-menu">
                <li class="nav-item active" data-section="dashboard">
                    <i>📊</i> Dashboard
                </li>
                <li class="nav-item" data-section="users">
                    <i>👥</i> Users
                </li>
                <li class="nav-item" data-section="orders">
                    <i>🛍️</i> Orders
                </li>
                <li class="nav-item" data-section="analytics">
                    <i>📈</i> Analytics
                </li>
                <li class="nav-item" data-section="settings">
                    <i>⚙️</i> Settings
                </li>
            </ul>
        </div>

        <div class="main-content">
            <div class="header">
                <h1 id="page-title">Dashboard</h1>
                <div class="user-info">
                    <span>Welcome back, John!</span>
                    <div class="user-avatar">JD</div>
                </div>
            </div>

            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon">👥</div>
                    <div class="stat-value" id="users-count">1,234</div>
                    <div class="stat-label">Total Users</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">🛍️</div>
                    <div class="stat-value" id="orders-count">456</div>
                    <div class="stat-label">Orders Today</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">💰</div>
                    <div class="stat-value" id="revenue-count">$12,345</div>
                    <div class="stat-label">Total Revenue</div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon">📈</div>
                    <div class="stat-value" id="growth-count">+23%</div>
                    <div class="stat-label">Growth Rate</div>
                </div>
            </div>

            <div class="content-grid">
                <div class="card">
                    <h3>Sales Chart</h3>
                    <div class="chart-container" id="chart-container">
                        <!-- Chart bars will be generated by JavaScript -->
                    </div>
                </div>

                <div class="card">
                    <h3>Recent Activity</h3>
                    <div class="recent-activity">
                        <div class="activity-item">
                            <div class="activity-icon">👤</div>
                            <div class="activity-text">
                                <div>New user registered</div>
                                <div class="activity-time">2 minutes ago</div>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon">💰</div>
                            <div class="activity-text">
                                <div>Payment received</div>
                                <div class="activity-time">5 minutes ago</div>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon">📦</div>
                            <div class="activity-text">
                                <div>Order shipped</div>
                                <div class="activity-time">10 minutes ago</div>
                            </div>
                        </div>
                        <div class="activity-item">
                            <div class="activity-icon">⚙️</div>
                            <div class="activity-text">
                                <div>System update completed</div>
                                <div class="activity-time">1 hour ago</div>
                            </div>
                        </div>
                    </div>
                    <button class="btn" style="margin-top: 1rem; width: 100%;">View All Activities</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Navigation functionality
        const navItems = document.querySelectorAll('.nav-item');
        const pageTitle = document.getElementById('page-title');

        navItems.forEach(item => {
            item.addEventListener('click', function() {
                // Remove active class from all items
                navItems.forEach(nav => nav.classList.remove('active'));
                // Add active class to clicked item
                this.classList.add('active');
                
                // Update page title
                const section = this.getAttribute('data-section');
                pageTitle.textContent = section.charAt(0).toUpperCase() + section.slice(1);
            });
        });

        // Generate chart bars
        function generateChart() {
            const chartContainer = document.getElementById('chart-container');
            const data = [65, 85, 45, 75, 95, 55, 80]; // Sample data
            
            chartContainer.innerHTML = '';
            
            data.forEach(value => {
                const bar = document.createElement('div');
                bar.className = 'chart-bar';
                bar.style.height = `${value}%`;
                bar.title = `${value}%`;
                chartContainer.appendChild(bar);
            });
        }

        // Animate counters
        function animateCounters() {
            const counters = [
                { id: 'users-count', target: 1234, suffix: '' },
                { id: 'orders-count', target: 456, suffix: '' },
                { id: 'revenue-count', target: 12345, suffix: '', prefix: '$' },
                { id: 'growth-count', target: 23, suffix: '%', prefix: '+' }
            ];

            counters.forEach(counter => {
                const element = document.getElementById(counter.id);
                let current = 0;
                const increment = counter.target / 100;
                
                const timer = setInterval(() => {
                    current += increment;
                    if (current >= counter.target) {
                        current = counter.target;
                        clearInterval(timer);
                    }
                    
                    let displayValue = Math.floor(current);
                    if (counter.prefix) displayValue = counter.prefix + displayValue;
                    if (counter.suffix) displayValue = displayValue + counter.suffix;
                    if (counter.id === 'revenue-count') displayValue = '$' + displayValue.toLocaleString();
                    
                    element.textContent = displayValue;
                }, 20);
            });
        }

        // Update stats periodically
        function updateStats() {
            const stats = {
                users: Math.floor(Math.random() * 100) + 1200,
                orders: Math.floor(Math.random() * 50) + 400,
                revenue: Math.floor(Math.random() * 5000) + 10000,
                growth: Math.floor(Math.random() * 10) + 20
            };

            document.getElementById('users-count').textContent = stats.users.toLocaleString();
            document.getElementById('orders-count').textContent = stats.orders;
            document.getElementById('revenue-count').textContent = '$' + stats.revenue.toLocaleString();
            document.getElementById('growth-count').textContent = '+' + stats.growth + '%';
        }

        // Initialize dashboard
        document.addEventListener('DOMContentLoaded', function() {
            generateChart();
            animateCounters();
            
            // Update stats every 30 seconds
            setInterval(updateStats, 30000);
        });

        // Add click handlers for chart bars
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('chart-bar')) {
                const value = e.target.style.height;
                alert(`Chart value: ${value}`);
            }
        });

        // Add some interactivity to stat cards
        document.querySelectorAll('.stat-card').forEach(card => {
            card.addEventListener('click', function() {
                this.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    this.style.transform = 'translateY(-5px)';
                }, 100);
            });
        });
    </script>
</body>
</html>