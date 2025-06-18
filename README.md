<h1>Ammonia Auto Control (AAC)</h1>

<p><strong>Ammonia Auto Control (AAC)</strong> is a Laravel-based web application designed to monitor and report ammonia levels in automated systems. It is ideal for agricultural, environmental, or industrial setups where gas detection and reporting are essential.</p>

<hr>

<h2>🛠️ Features</h2>
<ul>
  <li>🔐 <strong>Login Authentication</strong> – Secure user login with validation</li>
  <li>📊 <strong>Ammonia Reports</strong> – Real-time data display of ammonia readings</li>
  <li>📖 <strong>Help Documentation</strong> – Onboard guide for end-users</li>
  <li>🧠 Clean MVC structure with Blade templating</li>
</ul>

<hr>

<h2>📁 Project Structure (Key Files)</h2>
<table>
  <thead>
    <tr>
      <th>File</th>
      <th>Description</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><code>resources/views/login.blade.php</code></td>
      <td>Login page template</td>
    </tr>
    <tr>
      <td><code>resources/views/reports.blade.php</code></td>
      <td>Displays ammonia reading reports in a table</td>
    </tr>
    <tr>
      <td><code>resources/views/help.blade.php</code></td>
      <td>Static help/FAQ content</td>
    </tr>
    <tr>
      <td><code>.env</code></td>
      <td>Environment config (not tracked)</td>
    </tr>
    <tr>
      <td><code>routes/web.php</code></td>
      <td>Web routes definition</td>
    </tr>
  </tbody>
</table>

<hr>

<h2>📸 UI Summary</h2>

<h3>🔐 Login Page</h3>
<ul>
  <li>Includes branding/logo</li>
  <li>Email/password inputs</li>
  <li>Error display and form validation</li>
</ul>

<h3>📊 Reports Page</h3>
<ul>
  <li>Dynamic data table with timestamps</li>
  <li>Designed for responsiveness</li>
</ul>

<h3>📘 Help Page</h3>
<ul>
  <li>Explains how to use the system</li>
  <li>Includes step-by-step guidance</li>
</ul>

<hr>

<h2>🚀 Getting Started</h2>

<h3>📦 Requirements</h3>
<ul>
  <li>PHP 8.0+</li>
  <li>Laravel 10+</li>
  <li>MySQL or equivalent</li>
  <li>Composer</li>
</ul>

<h3>🔧 Installation</h3>
<pre><code>
git clone https://github.com/qppd/AmmoniaAutoControl.git
cd AmmoniaAutoControl
composer install
cp .env.example .env
php artisan key:generate
</code></pre>

<p>Edit your <code>.env</code> file and set the database credentials.</p>

<h3>▶️ Running the App</h3>
<pre><code>php artisan serve</code></pre>
<p>Open your browser and visit <code>http://localhost:8000</code></p>

<hr>

<h2>🧹 Notes</h2>
<ul>
  <li>Secrets (e.g., <code>firebase2.json</code>) are excluded from Git using <code>.gitignore</code>.</li>
  <li>Uses Bootstrap for layout and responsiveness.</li>
  <li>Run migrations with:</li>
</ul>

<pre><code>php artisan migrate</code></pre>

<hr>

<h2>📄 License</h2>
<p>This project is open-source under the <strong>MIT License</strong>.</p>

<hr>

<h2>🤝 Contributions</h2>
<p>Contributions are welcome. Please open an issue or pull request for major changes.</p>

<hr>

<h2>📬 Contact</h2>
<p>Maintained by <a href="https://github.com/qppd" target="_blank">QPPD</a>. For questions or issues, use the GitHub issue tracker.</p>
