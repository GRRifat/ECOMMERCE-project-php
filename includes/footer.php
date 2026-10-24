<!-- Customer Modern Luxury Footer Styling -->
<style>
  .customer-footer {
    background: #0b0f19 !important;
    border-top: 1px solid rgba(255, 255, 255, 0.08) !important;
    color: #94a3b8 !important;
    padding: 24px 0 !important;
    font-size: 13.5px !important;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    box-shadow: 0 -10px 30px rgba(0, 0, 0, 0.2);
  }
  .customer-footer .container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 15px;
  }
  .footer-github-link {
    color: #ffffff !important;
    font-weight: 600;
    text-decoration: none !important;
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 4px 12px;
    background: rgba(255, 255, 255, 0.06);
    border: 1px solid rgba(255, 255, 255, 0.12);
    border-radius: 8px;
    transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
  }
  .footer-github-link:hover {
    background: #ffffff;
    color: #0b0f19 !important;
    border-color: #ffffff;
    transform: translateY(-2px);
    box-shadow: 0 4px 14px rgba(255, 255, 255, 0.15);
  }
  .footer-status-pill {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 12px;
    font-weight: 600;
    color: #cbd5e1;
    background: rgba(255, 255, 255, 0.04);
    border: 1px solid rgba(255, 255, 255, 0.08);
    padding: 4px 12px;
    border-radius: 20px;
  }
  .footer-live-dot {
    width: 6px;
    height: 6px;
    background: #10b981;
    border-radius: 50%;
    display: inline-block;
    box-shadow: 0 0 8px rgba(16, 185, 129, 0.8);
  }
</style>

<footer class="main-footer customer-footer">
    <div class="container">
      <div>
        <strong style="color: #ffffff; font-weight: 700; letter-spacing: 0.3px;">Copyright &copy; 2026 THE CASUALISTS.</strong> 
        <span style="margin: 0 6px; opacity: 0.4;">|</span>
        Powered by 
        <a href="https://github.com/GRRifat" target="_blank" rel="noopener noreferrer" class="footer-github-link">
          <i class="fa fa-github" style="font-size: 15px;"></i> Gawshil Rahman Rifat
        </a>
      </div>

      <div class="hidden-xs">
        <span class="footer-status-pill">
          <span class="footer-live-dot"></span>
          <b>Store Online</b> • All rights reserved
        </span>
      </div>
    </div>
</footer>