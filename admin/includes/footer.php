<!-- Modern Admin Footer Styling -->
<style>
  .main-footer {
    background: #ffffff !important;
    border-top: 1px solid #e2e8f0 !important;
    color: #64748b !important;
    padding: 16px 24px !important;
    font-size: 13px !important;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    transition: all 0.3s ease;
  }
  .footer-github-link {
    color: #0f172a !important;
    font-weight: 700;
    text-decoration: none !important;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 3px 10px;
    background: #f1f5f9;
    border: 1px solid #e2e8f0;
    border-radius: 6px;
    transition: all 0.2s ease;
  }
  .footer-github-link:hover {
    background: #0f172a;
    color: #ffffff !important;
    border-color: #0f172a;
    transform: translateY(-1px);
    box-shadow: 0 4px 10px rgba(15, 23, 42, 0.15);
  }
  .footer-version-tag {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-size: 12px;
    font-weight: 600;
    color: #475569;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    padding: 3px 10px;
    border-radius: 20px;
  }
  .footer-pulse-dot {
    width: 6px;
    height: 6px;
    background: #10b981;
    border-radius: 50%;
    display: inline-block;
  }
</style>

<footer class="main-footer">
    <div class="pull-right hidden-xs">
      <span class="footer-version-tag">
        <span class="footer-pulse-dot"></span>
        <b>v2.0</b> • All rights reserved
      </span>
    </div>
    
    <div>
      <strong>Copyright &copy; 2026 The Casualists.</strong> 
      Powered by 
      <a href="https://github.com/GRRifat" target="_blank" rel="noopener noreferrer" class="footer-github-link">
        <i class="fa fa-github" style="font-size: 14px;"></i> Gawshil Rahman Rifat
      </a>
    </div>
</footer>