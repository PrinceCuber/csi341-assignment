<?php
// landing.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Academic Attachment Portal connecting students with industry opportunities">
    <title>Academic Attachment Portal | Student-Industry Bridge</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #005a9c;
            --primary-light: rgba(0, 90, 156, 0.8);
            --secondary: #a3d1f7;
            --white: #ffffff;
            --off-white: #f5f9fc;
            --text-dark: #2d3748;
            --text-light: #718096;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body, html {
            height: 100%;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, var(--primary-light), rgba(163, 209, 247, 0.7));
            color: var(--white);
            display: flex;
            flex-direction: column;
        }
        
        .header {
            padding: 20px 60px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--white);
            text-decoration: none;
        }
        
        .nav-links {
            display: flex;
            gap: 30px;
        }
        
        .nav-links a {
            color: var(--white);
            text-decoration: none;
            font-weight: 500;
            transition: opacity 0.3s;
        }
        
        .nav-links a:hover {
            opacity: 0.8;
        }
        
        .hero {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px;
        }
        
        .con {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 60px;
            background-color: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            max-width: 1200px;
            width: 90%;
            gap: 40px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .con .text {
            max-width: 50%;
        }
        
        .con h1 {
            font-size: 2.8rem;
            margin-bottom: 20px;
            line-height: 1.2;
            font-weight: 700;
        }
        
        .con p {
            font-size: 1.1rem;
            opacity: 0.9;
            margin-bottom: 30px;
            line-height: 1.6;
        }
        
        .con img {
            max-width: 45%;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            transition: transform 0.5s ease;
        }
        
        .con img:hover {
            transform: scale(1.03);
        }
        
        .cta-buttons {
            display: flex;
            gap: 20px;
            margin-top: 30px;
        }
        
        .btn {
            display: inline-block;
            padding: 14px 30px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s ease;
            text-align: center;
        }
        
        .btn-primary {
            background-color: var(--white);
            color: var(--primary);
            border: 2px solid var(--white);
        }
        
        .btn-primary:hover {
            background-color: transparent;
            color: var(--white);
        }
        
        .btn-secondary {
            background-color: transparent;
            color: var(--white);
            border: 2px solid var(--white);
        }
        
        .btn-secondary:hover {
            background-color: var(--white);
            color: var(--primary);
        }
        
        .features {
            display: flex;
            justify-content: space-around;
            flex-wrap: wrap;
            gap: 30px;
            margin-top: 60px;
            padding: 0 40px;
        }
        
        .feature-card {
            background-color: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(5px);
            border-radius: 12px;
            padding: 30px;
            width: 280px;
            text-align: center;
            transition: transform 0.3s ease;
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
        }
        
        .feature-icon {
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: var(--white);
        }
        
        .feature-card h3 {
            margin-bottom: 15px;
            font-size: 1.3rem;
        }
        
        footer {
            text-align: center;
            padding: 30px;
            background-color: rgba(0, 0, 0, 0.3);
            font-size: 14px;
            margin-top: 80px;
        }
        
        .footer-links {
            display: flex;
            justify-content: center;
            gap: 30px;
            margin-bottom: 20px;
        }
        
        .footer-links a {
            color: var(--white);
            text-decoration: none;
            transition: opacity 0.3s;
        }
        
        .footer-links a:hover {
            opacity: 0.8;
        }
        
        @media (max-width: 768px) {
            .header {
                padding: 20px;
                flex-direction: column;
                gap: 20px;
            }
            
            .con {
                flex-direction: column;
                padding: 40px 20px;
                text-align: center;
            }
            
            .con .text {
                max-width: 100%;
            }
            
            .con img {
                max-width: 80%;
                margin-top: 30px;
            }
            
            .cta-buttons {
                flex-direction: column;
                gap: 15px;
            }
            
            .features {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>
<body>
    <header class="header">
        <a href="#" class="logo">AttachmentPortal</a>
        <nav class="nav-links">
            <a href="#features">Features</a>
            <a href="about.php">About</a>
            <a href="contact.php">Contact</a>
        </nav>
    </header>

    <main class="hero">
        <div class="con">
            <div class="text">
                <h1>Transform Your Academic Journey</h1>
                <p>Connect with leading organizations and gain invaluable industrial experience through our comprehensive attachment program. Designed for students by educators.</p>
                <div class="cta-buttons">
                    <a href="login.php" class="btn btn-primary">Login</a>
                    <a href="signup.php" class="btn btn-secondary">Sign Up</a>
                </div>
            </div>
            <img src="https://static.vecteezy.com/system/resources/previews/014/577/352/original/connection-3d-icon-png.png" alt="Students connecting with industry professionals" loading="lazy">
        </div>
    </main>

    <section id="features" class="features">
        <div class="feature-card">
            <div class="feature-icon">📊</div>
            <h3>Smart Matching</h3>
            <p>Our algorithm connects you with organizations matching your skills and interests</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">📝</div>
            <h3>Easy Documentation</h3>
            <p>Submit logbooks and reports through our streamlined digital platform</p>
        </div>
        <div class="feature-card">
            <div class="feature-icon">🔔</div>
            <h3>Real-time Updates</h3>
            <p>Get instant notifications about your application status and deadlines</p>
        </div>
    </section>

    <footer>
        <div class="footer-links">
            <a href="privacy.php">Privacy Policy</a>
            <a href="terms.php">Terms of Service</a>
            <a href="faq.php">FAQ</a>
        </div>
        <p>&copy; <?php echo date("Y"); ?> Academic Attachment Portal. All rights reserved.</p>
    </footer>
</body>
</html>
