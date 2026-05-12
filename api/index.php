<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>BIG T</title>
  <link rel="icon" type="image/x-icon" href="/favicon.ico">
  <link rel="preconnect" href="https://fonts.googleapis.com"/>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
  <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=DM+Sans:wght@300;400;500&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet"/>
  <style>
    *, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }

    /* ── THEME TOKENS ── */
    :root {
      --acid: #c8ff00;
      --orange: #ff5c1a;
    }

    [data-theme="dark"] {
      --bg:       #050508;
      --bg2:      #111118;
      --bg3:      #1a1a22;
      --fg:       #f0ede8;
      --muted:    rgba(240,237,232,0.75);
      --border:   rgba(200,255,0,0.12);
      --border2:  rgba(240,237,232,0.08);
      --nav-bg:   rgba(5,5,8,0.78);
      --card-bg:  #050508;
      --input-bg: #111118;
      --tag-col:  #c8ff00;
    }

    /* ── ENHANCED LIGHT MODE ── */
    [data-theme="light"] {
      --bg:       #f9f7f2;
      --bg2:      #f0ece5;
      --bg3:      #e6e2d9;
      --fg:       #1a1814;
      --muted:    rgba(26,24,20,0.65);
      --border:   rgba(160,200,0,0.38);
      --border2:  rgba(26,24,20,0.11);
      --nav-bg:   rgba(249,247,242,0.92);
      --card-bg:  #faf8f4;
      --input-bg: #fcfaf6;
      --tag-col:  #4d6b00;
    }

    /* Light mode acid override — deeper olive-lime reads well on cream */
    [data-theme="light"] { --acid: #7ab800; }

    html { scroll-behavior:smooth; }
    body { background:var(--bg); color:var(--fg); font-family:'DM Sans',sans-serif; overflow-x:hidden; cursor:none; transition:background 0.4s, color 0.4s; }

    /* ── LIGHT MODE PAPER TEXTURE ── */
    [data-theme="light"] body::before {
      content:'';
      position:fixed;
      inset:0;
      pointer-events:none;
      z-index:0;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='300' height='300'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='300' height='300' filter='url(%23n)' opacity='0.032'/%3E%3C/svg%3E");
      opacity:1;
    }

    /* ── CURSOR ── */
    .cursor      { position:fixed; width:10px; height:10px; background:var(--acid); border-radius:50%; pointer-events:none; z-index:9999; transform:translate(-50%,-50%); mix-blend-mode:multiply; transition:background 0.3s; }
    [data-theme="dark"] .cursor { mix-blend-mode:difference; }
    .cursor-ring { position:fixed; width:38px; height:38px; border:1px solid var(--acid); border-radius:50%; pointer-events:none; z-index:9998; transform:translate(-50%,-50%); transition:border-color 0.3s, all 0.13s ease-out; opacity:0.45; }

    /* ── NAV ── */
    nav { position:fixed; top:0; left:0; right:0; z-index:200; display:flex; align-items:center; justify-content:space-between; padding:22px 60px; border-bottom:1px solid var(--border); backdrop-filter:blur(18px); background:var(--nav-bg); transition:background 0.4s, border-color 0.4s; }
    .nav-logo { font-family:'Bebas Neue',sans-serif; font-size:1.5rem; letter-spacing:0.12em; color:var(--acid); text-decoration:none; transition:color 0.3s; }
    .nav-links { display:flex; gap:32px; align-items:center; }
    .nav-links a { font-family:'Space Mono',monospace; font-size:0.63rem; letter-spacing:0.22em; color:var(--muted); text-decoration:none; text-transform:uppercase; transition:color 0.3s; }
    .nav-links a:hover, .nav-links a.active { color:var(--acid); }
    .nav-right { display:flex; gap:14px; align-items:center; }

    /* ── THEME TOGGLE ── */
    .theme-toggle { display:flex; align-items:center; gap:0; border:1px solid var(--border2); overflow:hidden; cursor:none; }
    .theme-btn { font-family:'Space Mono',monospace; font-size:0.58rem; letter-spacing:0.14em; text-transform:uppercase; padding:9px 16px; border:none; background:transparent; color:var(--muted); cursor:none; transition:background 0.3s, color 0.3s; white-space:nowrap; display:flex; align-items:center; gap:6px; }
    .theme-btn.active { background:var(--acid); color:#050508; }
    [data-theme="light"] .theme-btn.active { color:#1a1814; }
    .theme-btn svg { width:12px; height:12px; flex-shrink:0; }
    .nav-cta { font-family:'Space Mono',monospace; font-size:0.63rem; letter-spacing:0.15em; text-transform:uppercase; color:#050508; background:var(--acid); padding:10px 22px; border:none; cursor:none; transition:background 0.3s, transform 0.2s; text-decoration:none; display:inline-block; }
    [data-theme="light"] .nav-cta { color:#1a1814; }
    .nav-cta:hover { background:var(--orange); transform:skewX(-4deg); }
    [data-theme="light"] .nav-cta:hover { color:#fff; }

    /* ── HERO ── */
    .hero { min-height:100vh; display:flex; flex-direction:column; justify-content:center; position:relative; padding:130px 60px 80px; overflow:hidden; }
    #geo-canvas { position:absolute; inset:0; width:100%; height:100%; opacity:0.28; pointer-events:none; }
    [data-theme="light"] #geo-canvas { opacity:0.14; }
    .hero-eyebrow { font-family:'Space Mono',monospace; font-size:0.6rem; letter-spacing:0.44em; text-transform:uppercase; color:var(--acid); margin-bottom:22px; opacity:0; animation:fadeUp 0.6s 0.3s forwards; }
    .hero-title { font-family:'Bebas Neue',sans-serif; font-size:clamp(4rem,11vw,11rem); line-height:0.88; letter-spacing:-0.01em; position:relative; z-index:2; }
    .hero-title .word { overflow:hidden; display:block; }
    .hero-title .letter { display:inline-block; opacity:0; transform:translateY(110%) skewY(8deg); animation:letterIn 0.7s cubic-bezier(0.22,1,0.36,1) forwards; }
    .hero-title .word-2 .letter { color:var(--acid); }
    .hero-title .word-3 .letter { -webkit-text-stroke:1.5px var(--fg); color:transparent; }
    [data-theme="light"] .hero-title .word-3 .letter { -webkit-text-stroke:1.5px var(--fg); }
    .hero-sub { max-width:540px; font-size:1rem; color:var(--muted); line-height:1.82; margin-top:36px; opacity:0; animation:fadeUp 0.7s 1.4s forwards; }
    .hero-actions { display:flex; gap:18px; margin-top:48px; opacity:0; animation:fadeUp 0.7s 1.7s forwards; flex-wrap:wrap; }
    .hero-badge { position:absolute; top:140px; right:60px; z-index:3; display:flex; flex-direction:column; align-items:flex-end; gap:6px; opacity:0; animation:fadeUp 0.6s 2s forwards; }
    .badge-pill { font-family:'Space Mono',monospace; font-size:0.55rem; letter-spacing:0.25em; text-transform:uppercase; padding:8px 16px; border:1px solid var(--border); background:var(--bg3); color:var(--acid); }
    .hero-scroll { position:absolute; bottom:38px; left:60px; font-family:'Space Mono',monospace; font-size:0.56rem; letter-spacing:0.3em; color:var(--muted); text-transform:uppercase; opacity:0; animation:fadeUp 0.6s 2.2s forwards; display:flex; align-items:center; gap:12px; }
    .hero-scroll::before { content:''; display:block; width:28px; height:1px; background:var(--muted); }

    /* ── BUTTONS ── */
    .btn-primary { font-family:'Space Mono',monospace; font-size:0.66rem; letter-spacing:0.18em; text-transform:uppercase; color:#050508; background:var(--acid); padding:15px 38px; border:none; cursor:none; position:relative; overflow:hidden; transition:transform 0.2s; text-decoration:none; display:inline-block; }
    [data-theme="light"] .btn-primary { color:#1a1814; }
    .btn-primary::after { content:''; position:absolute; inset:0; background:var(--orange); transform:translateX(-101%); transition:transform 0.3s cubic-bezier(0.76,0,0.24,1); }
    .btn-primary:hover::after { transform:translateX(0); }
    .btn-primary:hover { transform:skewX(-3deg); }
    [data-theme="light"] .btn-primary:hover { color:#fff; }
    .btn-primary span { position:relative; z-index:1; }
    .btn-outline { font-family:'Space Mono',monospace; font-size:0.66rem; letter-spacing:0.18em; text-transform:uppercase; color:var(--fg); background:transparent; padding:15px 38px; border:1px solid var(--border2); cursor:none; transition:border-color 0.3s, color 0.3s; text-decoration:none; display:inline-flex; align-items:center; gap:10px; }
    .btn-outline:hover { border-color:var(--acid); color:var(--acid); }

    /* ── MARQUEE ── */
    .marquee-strip { border-top:1px solid var(--border); border-bottom:1px solid var(--border); padding:15px 0; overflow:hidden; background:var(--bg3); }
    [data-theme="light"] .marquee-strip { background:var(--bg3); }
    .marquee-inner { display:flex; width:max-content; animation:marquee 26s linear infinite; }
    .marquee-item { font-family:'Bebas Neue',sans-serif; font-size:0.95rem; letter-spacing:0.28em; color:var(--muted); padding:0 48px; white-space:nowrap; }
    .marquee-item b { color:var(--acid); font-weight:400; }

    /* ── SECTION COMMON ── */
    .section-label { font-family:'Space Mono',monospace; font-size:0.58rem; letter-spacing:0.44em; color:var(--acid); text-transform:uppercase; margin-bottom:52px; display:flex; align-items:center; gap:16px; }
    .section-label::before { content:''; display:block; width:36px; height:1px; background:var(--acid); }
    .section-title { font-family:'Bebas Neue',sans-serif; font-size:clamp(2.8rem,6vw,5.5rem); line-height:1; }

    /* ── PRODUCT OVERVIEW ── */
    #overview { padding:110px 60px; background:var(--bg2); }
    .overview-grid { display:grid; grid-template-columns:1fr 1.1fr; gap:80px; align-items:center; margin-top:70px; }
    .overview-visual { position:relative; }
    .overview-canvas-wrap { position:relative; border:1px solid var(--border); overflow:hidden; aspect-ratio:1; background:var(--bg); }
    [data-theme="light"] .overview-canvas-wrap { background:var(--bg); box-shadow:0 4px 40px rgba(26,24,20,0.07); }
    .overview-canvas-wrap canvas { width:100%; height:100%; display:block; }
    .overview-icon-overlay { position:absolute; inset:0; display:flex; align-items:center; justify-content:center; pointer-events:none; }
    .overview-info { display:flex; flex-direction:column; gap:32px; }
    .overview-tag { font-family:'Space Mono',monospace; font-size:0.58rem; letter-spacing:0.38em; color:var(--tag-col); text-transform:uppercase; }
    .overview-heading { font-family:'Bebas Neue',sans-serif; font-size:clamp(2.4rem,4vw,3.8rem); line-height:1.05; }
    .overview-heading span { color:var(--acid); }
    .overview-desc { font-size:0.95rem; color:var(--muted); line-height:1.85; }
    .feature-list { list-style:none; display:flex; flex-direction:column; gap:14px; }
    .feature-list li { font-family:'Space Mono',monospace; font-size:0.62rem; letter-spacing:0.1em; color:var(--muted); display:flex; align-items:center; gap:14px; }
    .feature-list li::before { content:''; display:block; width:20px; height:1px; background:var(--acid); flex-shrink:0; }
    .price-badge { display:inline-flex; align-items:baseline; gap:4px; border:1px solid var(--border); padding:18px 28px; background:var(--bg3); }
    [data-theme="light"] .price-badge { box-shadow:0 2px 16px rgba(26,24,20,0.06); }
    .price-badge .sym { font-family:'Space Mono',monospace; font-size:0.75rem; color:var(--acid); margin-bottom:4px; }
    .price-badge .amt { font-family:'Bebas Neue',sans-serif; font-size:3.2rem; color:var(--acid); line-height:1; }
    .price-badge .per { font-family:'Space Mono',monospace; font-size:0.58rem; color:var(--muted); letter-spacing:0.1em; margin-bottom:4px; }

    /* ── FEATURES DEEP DIVE ── */
    #features { padding:110px 60px; }
    .features-intro { display:grid; grid-template-columns:1fr 1fr; gap:60px; align-items:flex-end; margin-bottom:80px; }
    .features-intro p { font-size:0.95rem; color:var(--muted); line-height:1.85; }
    .features-cards { display:grid; grid-template-columns:repeat(2,1fr); gap:2px; }
    .feat-card { padding:52px 44px; background:var(--bg2); border:1px solid var(--border2); position:relative; overflow:hidden; transition:border-color 0.4s, background 0.4s, box-shadow 0.4s; }
    [data-theme="light"] .feat-card { box-shadow:0 1px 8px rgba(26,24,20,0.04); }
    .feat-card:hover { border-color:var(--acid); background:var(--bg3); }
    [data-theme="light"] .feat-card:hover { box-shadow:0 4px 24px rgba(122,184,0,0.10); }
    .feat-card::before { content:''; position:absolute; top:0; left:0; width:3px; height:0; background:var(--acid); transition:height 0.4s cubic-bezier(0.22,1,0.36,1); }
    .feat-card:hover::before { height:100%; }
    .feat-num { font-family:'Bebas Neue',sans-serif; font-size:4.5rem; color:rgba(200,255,0,0.40); line-height:1; position:absolute; top:16px; right:28px; }
    [data-theme="light"] .feat-num { color:rgba(122,184,0,0.40); }
    .feat-icon { margin-bottom:28px; }
    .feat-title { font-family:'Bebas Neue',sans-serif; font-size:1.8rem; letter-spacing:0.04em; margin-bottom:14px; color:var(--fg); }
    .feat-desc { font-size:0.87rem; color:var(--muted); line-height:1.8; }

    /* ── HOW IT WORKS ── */
    #how { padding:110px 60px; background:var(--bg2); }
    .steps-grid { display:grid; grid-template-columns:repeat(4,1fr); gap:2px; margin-top:70px; }
    .step-item { padding:44px 32px; background:var(--bg); border:1px solid var(--border2); position:relative; transition:border-color 0.4s, box-shadow 0.4s; }
    [data-theme="light"] .step-item { box-shadow:0 1px 8px rgba(26,24,20,0.04); }
    .step-item:hover { border-color:var(--acid); }
    [data-theme="light"] .step-item:hover { box-shadow:0 4px 20px rgba(122,184,0,0.09); }
    .step-item:not(:last-child)::after { content:'→'; position:absolute; right:-14px; top:50%; transform:translateY(-50%); font-size:1rem; color:var(--acid); z-index:2; font-family:'Space Mono',monospace; }
    .step-num { font-family:'Bebas Neue',sans-serif; font-size:3.5rem; color:rgba(200,255,0,0.40); line-height:1; margin-bottom:18px; }
    [data-theme="light"] .step-num { color:rgba(122,184,0,0.40); }
    .step-title { font-family:'Bebas Neue',sans-serif; font-size:1.4rem; letter-spacing:0.04em; margin-bottom:12px; color:var(--fg); }
    .step-desc { font-size:0.82rem; color:var(--muted); line-height:1.8; }

    /* ── STATS ── */
    .stats-strip { padding:72px 60px; border-top:1px solid var(--border); border-bottom:1px solid var(--border); background:var(--bg3); }
    .stats-grid { display:grid; grid-template-columns:repeat(4,1fr); gap:40px; }
    .stat-item { text-align:center; }
    .stat-num { font-family:'Bebas Neue',sans-serif; font-size:clamp(2.8rem,5vw,5rem); color:var(--acid); line-height:1; display:block; }
    .stat-label { font-family:'Space Mono',monospace; font-size:0.56rem; letter-spacing:0.3em; color:var(--muted); text-transform:uppercase; margin-top:10px; }

    /* ── BIG QUOTE ── */
    .big-text-section { padding:110px 60px; position:relative; overflow:hidden; }
    [data-theme="light"] .big-text-section { background:linear-gradient(135deg, var(--bg) 0%, var(--bg2) 100%); }
    .big-statement { font-family:'Bebas Neue',sans-serif; font-size:clamp(3rem,7.5vw,7.5rem); line-height:1.0; max-width:1100px; }
    .big-statement em { font-style:normal; -webkit-text-stroke:1px var(--acid); color:transparent; }
    [data-theme="light"] .big-statement em { -webkit-text-stroke:1.5px var(--acid); }
    .big-statement .ac { color:var(--acid); }
    .geo-decor { position:absolute; right:60px; top:50%; transform:translateY(-50%); opacity:0.1; }
    [data-theme="light"] .geo-decor { opacity:0.08; }

    /* ── PRICING ── */
    #pricing { padding:110px 60px; background:var(--bg2); }
    .pricing-card {background: var(--bg);border: 1px solid var(--border);padding: 60px 52px;position: relative;display: flex;flex-direction: column;height: 100%;}
    [data-theme="light"] .pricing-card { box-shadow:0 8px 48px rgba(26,24,20,0.09); border-color:rgba(122,184,0,0.25); }
    .pricing-card::before { content:'BEST VALUE'; position:absolute; top:-12px; left:40px; font-family:'Space Mono',monospace; font-size:0.55rem; letter-spacing:0.2em; background:var(--acid); color:#050508; padding:4px 14px; }
    [data-theme="light"] .pricing-card::before { color:#1a1814; }
    .pricing-name { font-family:'Bebas Neue',sans-serif; font-size:2rem; letter-spacing:0.08em; color:var(--acid); margin-bottom:8px; }
    .pricing-amount { font-family:'Bebas Neue',sans-serif; font-size:5rem; line-height:1; color:var(--fg); }
    .pricing-amount sup { font-family:'Space Mono',monospace; font-size:1rem; vertical-align:super; color:var(--acid); }
    .pricing-period { font-family:'Space Mono',monospace; font-size:0.58rem; color:var(--muted); letter-spacing:0.18em; margin-bottom:40px; margin-top:4px; }
    .pricing-divider { border:none; border-top:1px solid var(--border2); margin-bottom:32px; }
    .pricing-list {list-style: none;display: flex;flex-direction: column;gap: 14px;margin-bottom: 48px;flex-grow: 1;}
    .pricing-list li { font-size:0.88rem; color:var(--muted); display:flex; align-items:flex-start; gap:10px; line-height:1.6; }
    .pricing-list li::before { content:'✦'; color:var(--acid); font-size:0.5rem; flex-shrink:0; margin-top:4px; }
    .btn-pricing-full { width:100%; font-family:'Space Mono',monospace; font-size:0.65rem; letter-spacing:0.18em; text-transform:uppercase; color:#050508; background:var(--acid); padding:16px 0; border:none; cursor:none; position:relative; overflow:hidden; transition:transform 0.2s; }
    [data-theme="light"] .btn-pricing-full { color:#1a1814; }
    .btn-pricing-full::after { content:''; position:absolute; inset:0; background:var(--orange); transform:translateX(-101%); transition:transform 0.3s; }
    .btn-pricing-full:hover::after { transform:translateX(0); }
    .btn-pricing-full:hover { transform:skewX(-2deg); }
    [data-theme="light"] .btn-pricing-full:hover { color:#fff; }
    .btn-pricing-full span { position:relative; z-index:1; }
    .pricing-note { text-align:center; font-family:'Space Mono',monospace; font-size:0.55rem; color:var(--muted); letter-spacing:0.15em; margin-top:20px; opacity:0.9; }
    .pricing-wrapper { max-width:1200px; margin:70px auto 0; }
    .pricing-grid {display: grid;grid-template-columns: repeat(3, 1fr);gap: 20px;align-items: stretch;}
    .pricing-card-bottom { margin-top:auto; }

    /* ── CONTACT / CTA ── */
    #contact { padding:0; }
    .contact-body { display:grid; grid-template-columns:1fr 1fr; gap:2px; background:var(--border2); }
    .contact-info { background:var(--bg2); padding:80px 60px; }
    .contact-channels { display:flex; flex-direction:column; gap:2px; margin-bottom:52px; }
    .channel-item { padding:26px 30px; background:var(--card-bg); border:1px solid var(--border2); display:flex; align-items:flex-start; gap:22px; transition:border-color 0.3s, background 0.3s, box-shadow 0.3s; }
    [data-theme="light"] .channel-item { box-shadow:0 1px 8px rgba(26,24,20,0.04); }
    .channel-item:hover { border-color:var(--acid); background:var(--bg3); }
    [data-theme="light"] .channel-item:hover { box-shadow:0 4px 18px rgba(122,184,0,0.1); }
    .channel-icon { width:36px; height:36px; flex-shrink:0; display:flex; align-items:center; justify-content:center; }
    .channel-label { font-family:'Space Mono',monospace; font-size:0.53rem; letter-spacing:0.35em; color:var(--acid); text-transform:uppercase; margin-bottom:6px; }
    .channel-value { font-size:1.05rem; letter-spacing:0.05em; color:var(--fg); }
    .channel-sub { font-size:0.75rem; color:var(--muted); margin-top:4px; }
    .avail-strip { padding:26px 30px; background:var(--bg3); border:1px solid var(--border); display:flex; align-items:center; gap:14px; }
    .avail-dot { width:8px; height:8px; border-radius:50%; background:var(--acid); flex-shrink:0; box-shadow:0 0 10px var(--acid); animation:pulse 1.8s ease-in-out infinite; }
    .avail-text { font-family:'Space Mono',monospace; font-size:0.58rem; letter-spacing:0.2em; color:var(--fg); text-transform:uppercase; }
    .avail-text span { color:var(--acid); }

    .contact-form-wrap { background:var(--card-bg); padding:80px 60px; }
    [data-theme="light"] .contact-form-wrap { background:var(--bg); box-shadow:inset 0 0 0 1px var(--border2); }
    .form-error { color: #ff5c1a; font-family:'Space Mono',monospace; font-size:0.53rem; letter-spacing:0.2em; margin-top:6px; }
    .form-field.invalid { border-color: #ff5c1a; }
    .check-options .check-error { color: #ff5c1a; font-family:'Space Mono',monospace; font-size:0.53rem; letter-spacing:0.2em; margin-top:8px; }
    .form-title { font-family:'Bebas Neue',sans-serif; font-size:2.8rem; letter-spacing:0.04em; margin-bottom:44px; line-height:1; }
    .form-title span { color:var(--acid); }
    .form-row { display:grid; grid-template-columns:1fr 1fr; gap:2px; margin-bottom:2px; }
    .form-field { display:flex; flex-direction:column; background:var(--input-bg); border:1px solid var(--border2); transition:border-color 0.3s, box-shadow 0.3s; }
    [data-theme="light"] .form-field { box-shadow:0 1px 4px rgba(26,24,20,0.04); }
    .form-field.full { grid-column:span 2; }
    .form-field:focus-within { border-color:var(--acid); }
    [data-theme="light"] .form-field:focus-within { box-shadow:0 0 0 3px rgba(122,184,0,0.12); }
    .field-label { font-family:'Space Mono',monospace; font-size:0.53rem; letter-spacing:0.35em; color:var(--acid); text-transform:uppercase; padding:16px 22px 0; }
    .field-input { background:transparent; border:none; outline:none; color:var(--fg); font-family:'DM Sans',sans-serif; font-size:0.93rem; padding:8px 22px 16px; resize:none; cursor:none; }
    .field-input::placeholder { color:var(--muted); opacity:0.9; }
    textarea.field-input { min-height:130px; }
    .form-check-group { padding:24px 22px; border:1px solid var(--border2); background:var(--input-bg); margin-bottom:2px; }
    [data-theme="light"] .form-check-group { box-shadow:0 1px 4px rgba(26,24,20,0.04); }
    .form-check-label { font-family:'Space Mono',monospace; font-size:0.53rem; letter-spacing:0.35em; color:var(--acid); text-transform:uppercase; margin-bottom:14px; display:block; }
    .check-options { display:flex; flex-wrap:wrap; gap:8px; }
    .check-opt { display:flex; align-items:center; gap:7px; cursor:none; }
    .check-opt input { display:none; }
    .check-box { width:13px; height:13px; border:1px solid rgba(200,255,0,0.35); flex-shrink:0; position:relative; transition:background 0.2s, border-color 0.2s; }
    [data-theme="light"] .check-box { border-color:rgba(122,184,0,0.4); }
    .check-opt input:checked + .check-box { background:var(--acid); border-color:var(--acid); }
    .check-opt input:checked + .check-box::after { content:''; position:absolute; top:2px; left:2px; width:7px; height:7px; background:#050508; }
    [data-theme="light"] .check-opt input:checked + .check-box::after { background:#1a1814; }
    .check-opt-label { font-family:'Space Mono',monospace; font-size:0.58rem; letter-spacing:0.1em; color:var(--muted); text-transform:uppercase; transition:color 0.2s; }
    .check-opt:has(input:checked) .check-opt-label { color:var(--acid); }
    .form-bottom { display:flex; align-items:center; justify-content:space-between; margin-top:2px; gap:20px; flex-wrap:wrap; }
    .form-disclaimer { font-family:'Space Mono',monospace; font-size:0.53rem; letter-spacing:0.1em; color:var(--muted); opacity:0.9; max-width:280px; line-height:1.7; }
    .btn-submit { font-family:'Space Mono',monospace; font-size:0.65rem; letter-spacing:0.18em; text-transform:uppercase; color:#050508; background:var(--acid); padding:16px 40px; border:none; cursor:none; position:relative; overflow:hidden; transition:transform 0.2s; flex-shrink:0; }
    [data-theme="light"] .btn-submit { color:#1a1814; }
    .btn-submit::after { content:''; position:absolute; inset:0; background:var(--orange); transform:translateX(-101%); transition:transform 0.3s cubic-bezier(0.76,0,0.24,1); }
    .btn-submit:hover::after { transform:translateX(0); }
    .btn-submit:hover { transform:skewX(-3deg); }
    [data-theme="light"] .btn-submit:hover { color:#fff; }
    .btn-submit span { position:relative; z-index:1; }
    .form-success { display:none; padding:60px 40px; text-align:center; }
    .form-success.show { display:block; }
    .success-title { font-family:'Bebas Neue',sans-serif; font-size:3rem; color:var(--acid); margin-bottom:12px; margin-top:20px; }
    .success-sub { font-size:0.9rem; color:var(--muted); line-height:1.8; }

    /* ── FOOTER ── */
    footer { padding:36px 60px; border-top:1px solid var(--border); display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:16px; background:var(--bg); }
    .footer-brand { font-family:'Bebas Neue',sans-serif; font-size:1.3rem; letter-spacing:0.12em; color:var(--acid); }
    .footer-copy { font-family:'Space Mono',monospace; font-size:0.56rem; color:var(--muted); letter-spacing:0.15em; }
    .footer-links { display:flex; gap:26px; }
    .footer-links a { font-family:'Space Mono',monospace; font-size:0.56rem; letter-spacing:0.15em; color:var(--muted); text-decoration:none; text-transform:uppercase; transition:color 0.3s; }
    .footer-links a:hover { color:var(--acid); }

    /* ── LIGHT MODE: SVG STROKE OVERRIDES ── */
    [data-theme="light"] .channel-icon svg { stroke:#4d6b00; }
    [data-theme="light"] .feat-card svg rect, [data-theme="light"] .feat-card svg circle,
    [data-theme="light"] .feat-card svg line, [data-theme="light"] .feat-card svg path,
    [data-theme="light"] .feat-card svg polyline, [data-theme="light"] .feat-card svg polygon { stroke:#4d6b00; }
    [data-theme="light"] .feat-card svg rect[fill="#c8ff00"], [data-theme="light"] .feat-card svg circle[fill="#c8ff00"] { fill:#7ab800; }
    [data-theme="light"] .feat-card svg circle[fill="#ff5c1a"] { fill:#ff5c1a; }
    [data-theme="light"] .overview-icon-overlay svg [stroke="#c8ff00"] { stroke:#4d6b00; }
    [data-theme="light"] .overview-icon-overlay svg [stroke="#ff5c1a"] { stroke:#e05010; }
    [data-theme="light"] .overview-icon-overlay svg [fill="#c8ff00"] { fill:#7ab800; }
    [data-theme="light"] .overview-icon-overlay svg [fill="#ff5c1a"] { fill:#e05010; }

    /* ── ANIMATIONS ── */
    @keyframes letterIn  { to { opacity:1; transform:translateY(0) skewY(0); } }
    @keyframes fadeUp    { from{opacity:0;transform:translateY(22px);} to{opacity:1;transform:translateY(0);} }
    @keyframes marquee   { from{transform:translateX(0);} to{transform:translateX(-50%);} }
    @keyframes spin-slow { from{transform:rotate(0deg);} to{transform:rotate(360deg);} }
    @keyframes spin-rev  { from{transform:rotate(0deg);} to{transform:rotate(-360deg);} }
    @keyframes pulse     { 0%,100%{opacity:1;transform:scale(1);} 50%{opacity:0.55;transform:scale(1.35);} }

    /* ── RESPONSIVE ── */
    @media(max-width:900px){
      nav { padding:18px 22px; }
      .nav-links { display:none; }
      .hero, #overview, #features, #how, .big-text-section, #pricing { padding:80px 22px; }
      .stats-strip, .contact-info, .contact-form-wrap { padding:60px 22px; }
      .overview-grid { grid-template-columns:1fr; gap:44px; }
      .features-intro { grid-template-columns:1fr; }
      .features-cards { grid-template-columns:1fr; }
      .steps-grid { grid-template-columns:1fr 1fr; }
      .step-item:not(:last-child)::after { display:none; }
      .stats-grid { grid-template-columns:1fr 1fr; }
      .contact-body { grid-template-columns:1fr; }
      footer { padding:28px 22px; }
      .hero-badge { display:none; }
      .geo-decor { display:none; }
      .pricing-card { padding:40px 28px; }
      .form-row { grid-template-columns:1fr; }
      .form-field.full { grid-column:span 1; }
      .pricing-grid { grid-template-columns:1fr; }
    }

/* ── TEAM SECTION ───────────────────────────── */
#team {
  padding: 110px 60px;
  background: var(--bg);
  position: relative;
  overflow: hidden;
}

.team-header {
  margin-bottom: 70px;
}

.team-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 22px;
}

.team-card {
  position: relative;
  overflow: hidden;
  background: var(--bg2);
  border: 1px solid var(--border2);
  aspect-ratio: 0.8;
  transition:
    transform 0.4s cubic-bezier(0.22,1,0.36,1),
    border-color 0.3s,
    box-shadow 0.4s;
  cursor: none;
}

[data-theme="light"] .team-card {
  box-shadow: 0 2px 12px rgba(26,24,20,0.05);
}

.team-card:hover {
  transform: translateY(-10px);
  border-color: var(--acid);
}

[data-theme="light"] .team-card:hover {
  box-shadow: 0 10px 30px rgba(122,184,0,0.15);
}

.team-card img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  filter: grayscale(100%);
  transition:
    transform 0.5s ease,
    filter 0.5s ease;
}

.team-card:hover img {
  transform: scale(1.06);
  filter: grayscale(0%);
}

/* overlay gradient */
.team-overlay {
  position: absolute;
  inset: auto 0 0 0;
  padding: 28px 24px;
  background:
    linear-gradient(
      to top,
      rgba(5,5,8,0.96) 0%,
      rgba(5,5,8,0.75) 45%,
      transparent 100%
    );
  z-index: 2;
}

[data-theme="light"] .team-overlay {
  background:
    linear-gradient(
      to top,
      rgba(249,247,242,0.96) 0%,
      rgba(249,247,242,0.75) 45%,
      transparent 100%
    );
}

.team-role {
  font-family: 'Space Mono', monospace;
  font-size: 0.52rem;
  letter-spacing: 0.35em;
  text-transform: uppercase;
  color: var(--acid);
  margin-bottom: 10px;
}

.team-name {
  font-family: 'Bebas Neue', sans-serif;
  font-size: 1.8rem;
  line-height: 1;
  color: var(--fg);
  letter-spacing: 0.04em;
}

.team-tag {
  margin-top: 10px;
  font-size: 0.78rem;
  color: var(--muted);
  line-height: 1.6;
}

/* team number */
.team-num {
  position: absolute;
  top: 16px;
  right: 18px;
  z-index: 3;
  font-family: 'Bebas Neue', sans-serif;
  font-size: 3.6rem;
  line-height: 1;
  color: rgba(200,255,0,0.48);
  pointer-events: none;
}

[data-theme="light"] .team-num {
  color: rgba(122,184,0,0.52);
}

/* scanning effect */
.team-scan {
  position: absolute;
  inset: 0;
  z-index: 2;
  background:
    linear-gradient(
      to bottom,
      transparent 0%,
      rgba(200,255,0,0.08) 50%,
      transparent 100%
    );
  transform: translateY(-100%);
  transition: transform 0.8s ease;
  pointer-events: none;
}

.team-card:hover .team-scan {
  transform: translateY(100%);
}

/* subtle border glow */
.team-card::before {
  content: '';
  position: absolute;
  inset: 0;
  border: 1px solid transparent;
  z-index: 3;
  transition: border-color 0.3s;
}

.team-card:hover::before {
  border-color: rgba(200,255,0,0.4);
}

/* responsive */
@media(max-width:1100px){
  .team-grid {
    grid-template-columns: repeat(2,1fr);
  }
}

@media(max-width:700px){
  #team {
    padding: 80px 22px;
  }

  .team-grid {
    grid-template-columns: 1fr;
  }

  .team-card {
    aspect-ratio: 0.9;
  }

  .team-name {
    font-size: 1.5rem;
  }
}
  </style>
</head>
<body>

<div class="cursor" id="cursor"></div>
<div class="cursor-ring" id="cursorRing"></div>

<!-- NAV -->
<nav>
  <!-- <a class="nav-logo" href="#">BIG T</a> -->
   <a class="nav-logo" aria-label="BIG T Home">
    <img src="/logo.png" alt="BIG T Logo" style="height:42px; width:auto; display:block; object-fit:contain; border-radius:20px;" loading="lazy"/>
  </a>
  <div class="nav-links">
    <a href="#overview">Product</a>
    <a href="#features">Features</a>
    <a href="#how">How It Works</a>
    <a href="#pricing">Pricing</a>
    <a href="#contact">Contact</a>
    <a href="#team">Team</a>
  </div>
  <div class="nav-right">
    <div class="theme-toggle" id="themeToggle">
      <button class="theme-btn active" id="btnDark" onclick="setTheme('dark')">
        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12.5 8.5A5.5 5.5 0 116 2c-.5 2 .5 5.5 4 5.5a5.5 5.5 0 012.5 1z" fill="currentColor" stroke="none" opacity=".9"/></svg>
        Dark
      </button>
      <button class="theme-btn" id="btnLight" onclick="setTheme('light')">
        <svg viewBox="0 0 14 14" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="7" cy="7" r="3"/><line x1="7" y1="1" x2="7" y2="2.5"/><line x1="7" y1="11.5" x2="7" y2="13"/><line x1="1" y1="7" x2="2.5" y2="7"/><line x1="11.5" y1="7" x2="13" y2="7"/><line x1="2.9" y1="2.9" x2="3.9" y2="3.9"/><line x1="10.1" y1="10.1" x2="11.1" y2="11.1"/><line x1="11.1" y1="2.9" x2="10.1" y2="3.9"/><line x1="3.9" y1="10.1" x2="2.9" y2="11.1"/></svg>
        Light
      </button>
    </div>
    <a href="#contact" class="nav-cta">Get Access</a>
  </div>
</nav>

<!-- HERO -->
<section class="hero">
  <canvas id="geo-canvas"></canvas>
  <div class="hero-eyebrow">// BIG T — Interactive Design Suite</div>
  <h1 class="hero-title" id="hero-title"></h1>
  <p class="hero-sub">Design your dream cake in real-time every tier, flavor, topping, and decoration before it ever touches an oven. Powered by interactive 3D tools and an instant cost estimator.</p>
  <div class="hero-actions">
    <a href="#overview" class="btn-primary"><span>Explore the Product</span></a>
    <a href="#contact" class="btn-outline">
      <svg width="12" height="12" viewBox="0 0 12 12" fill="currentColor"><polygon points="1,0 11,6 1,12"/></svg>
      Get Access
    </a>
    <a href="/demo-cake3d.html" class="btn-outline" style="margin-left:12px;">
      <svg width="12" height="12" viewBox="0 0 12 12" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M2 1l8 5-8 5V1z" stroke-linejoin="round"/></svg>
      Try Demo
    </a>
  </div>
  <div class="hero-scroll">Scroll to explore</div>
</section>

<!-- MARQUEE -->
<div class="marquee-strip">
  <div class="marquee-inner" id="marquee"></div>
</div>

<!-- PRODUCT OVERVIEW -->
<section id="overview">
  <div class="section-label">Product Overview</div>
  <div class="overview-grid">
    <div class="overview-visual">
      <div class="overview-canvas-wrap">
        <canvas id="prodCanvas"></canvas>
        <div class="overview-icon-overlay">
          <svg width="130" height="130" viewBox="0 0 120 120" fill="none">
            <rect x="20" y="70" width="80" height="30" rx="2" stroke="#c8ff00" stroke-width="1.5"/>
            <rect x="30" y="50" width="60" height="22" rx="2" stroke="#c8ff00" stroke-width="1.5"/>
            <rect x="40" y="34" width="40" height="18" rx="2" stroke="#c8ff00" stroke-width="1.5"/>
            <line x1="55" y1="34" x2="55" y2="24" stroke="#ff5c1a" stroke-width="1.5"/>
            <line x1="60" y1="34" x2="60" y2="21" stroke="#c8ff00" stroke-width="1.5"/>
            <line x1="65" y1="34" x2="65" y2="24" stroke="#ff5c1a" stroke-width="1.5"/>
            <circle cx="55" cy="22" r="2.5" fill="#ff5c1a"/>
            <circle cx="60" cy="19" r="2.5" fill="#c8ff00"/>
            <circle cx="65" cy="22" r="2.5" fill="#ff5c1a"/>
            <path d="M20 85 Q60 78 100 85" stroke="#c8ff00" stroke-width="0.7" opacity="0.5"/>
            <path d="M30 62 Q60 55 90 62" stroke="#c8ff00" stroke-width="0.7" opacity="0.5"/>
            <path d="M40 43 Q60 38 80 43" stroke="#c8ff00" stroke-width="0.7" opacity="0.5"/>
          </svg>
        </div>
      </div>
    </div>
    <div class="overview-info">
  <div>
    <div class="overview-tag">// Interactive Design</div>

    <h2 class="overview-heading">
      BASIC 3D CAKE<br>
      <span>CUSTOMIZATION</span>
    </h2>
  </div>

  <p class="overview-desc">
    A beginner-friendly 3D cake customization system designed for small bakeries and startups. Create simple cake designs with essential customization tools, standard templates, and online ordering support for customers.
  </p>

  <ul class="feature-list">
    <li>Basic 3D cake customization interface</li>
    <li>Limited design elements and decorations</li>
    <li>Standard cake templates included</li>
    <li>Online order form integration</li>
    <li>Customer support via email/chat</li>
  </ul>

  <div style="display:flex; align-items:center; gap:20px; flex-wrap:wrap;">
    
    <div class="price-badge">
      <span class="sym">₱</span>
      <span class="amt">1,499</span>
      <span class="per">/ month</span>
    </div>

    <a href="#contact" class="btn-primary">
      <span>Get Basic Plan →</span>
    </a>

      </div>
    </div>
  </div>
</section>

<!-- FEATURES DEEP DIVE -->
<section id="features">
  <div class="features-intro">
    <div>
      <div class="section-label">Core Features</div>
      <h2 class="section-title">WHAT'S<br>INSIDE.</h2>
    </div>
    <p>Four precision-built capabilities working together to give bakers and their customers the most intuitive cake design experience available no 3D skills needed.</p>
  </div>
  <div class="features-cards">
    <div class="feat-card">
      <div class="feat-num">01</div>
      <div class="feat-icon">
        <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
          <rect x="4" y="4" width="32" height="32" rx="2" stroke="#c8ff00" stroke-width="1.2"/>
          <rect x="10" y="22" width="20" height="10" fill="#c8ff00" opacity="0.1" stroke="#c8ff00" stroke-width="0.8"/>
          <rect x="12" y="16" width="16" height="8" fill="#c8ff00" opacity="0.15" stroke="#c8ff00" stroke-width="0.8"/>
          <rect x="14" y="11" width="12" height="7" fill="#c8ff00" opacity="0.2" stroke="#c8ff00" stroke-width="0.8"/>
        </svg>
      </div>
      <div class="feat-title">Real-Time 3D Preview</div>
      <p class="feat-desc">See your cake build in three dimensions as you make changes. Rotate the view, zoom in on decorations, and inspect every tier before committing to the final design.</p>
    </div>
    <div class="feat-card">
      <div class="feat-num">02</div>
      <div class="feat-icon">
        <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
          <circle cx="20" cy="20" r="14" stroke="#c8ff00" stroke-width="1.2"/>
          <circle cx="10" cy="10" r="4" fill="#ff5c1a" opacity="0.8"/>
          <circle cx="30" cy="10" r="3" fill="#c8ff00" opacity="0.6"/>
          <circle cx="20" cy="30" r="3.5" fill="#c8ff00" opacity="0.6"/>
          <line x1="10" y1="10" x2="20" y2="20" stroke="#c8ff00" stroke-width="0.8" stroke-dasharray="2 2"/>
          <line x1="30" y1="10" x2="20" y2="20" stroke="#c8ff00" stroke-width="0.8" stroke-dasharray="2 2"/>
          <line x1="20" y1="30" x2="20" y2="20" stroke="#c8ff00" stroke-width="0.8" stroke-dasharray="2 2"/>
        </svg>
      </div>
      <div class="feat-title">Drag & Drop Tools</div>
      <p class="feat-desc">Intuitive drag-and-drop controls let you place tiers, choose flavors, swap frostings, and position decorations exactly where you want them no technical training required.</p>
    </div>
    <div class="feat-card">
      <div class="feat-num">03</div>
      <div class="feat-icon">
        <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
          <rect x="4" y="8" width="32" height="24" rx="2" stroke="#c8ff00" stroke-width="1.2"/>
          <line x1="4" y1="16" x2="36" y2="16" stroke="#c8ff00" stroke-width="0.7" opacity="0.3"/>
          <rect x="9" y="21" width="5" height="7" fill="#c8ff00" opacity="0.3" stroke="#c8ff00" stroke-width="0.7"/>
          <rect x="17" y="19" width="5" height="9" fill="#c8ff00" opacity="0.5" stroke="#c8ff00" stroke-width="0.7"/>
          <rect x="25" y="22" width="5" height="6" fill="#c8ff00" opacity="0.2" stroke="#c8ff00" stroke-width="0.7"/>
          <line x1="9" y1="12" x2="16" y2="12" stroke="#c8ff00" stroke-width="0.8" opacity="0.5"/>
        </svg>
      </div>
      <div class="feat-title">Auto Cost Estimator</div>
      <p class="feat-desc">Every design choice tiers added, premium flavors selected, elaborate decorations placed instantly updates a live price estimate. Customers always know what they're ordering.</p>
    </div>
    <div class="feat-card">
      <div class="feat-num">04</div>
      <div class="feat-icon">
        <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
          <rect x="6" y="4" width="28" height="32" rx="2" stroke="#c8ff00" stroke-width="1.2"/>
          <line x1="11" y1="12" x2="29" y2="12" stroke="#c8ff00" stroke-width="0.9" opacity="0.5"/>
          <line x1="11" y1="18" x2="24" y2="18" stroke="#c8ff00" stroke-width="0.9" opacity="0.4"/>
          <line x1="11" y1="24" x2="26" y2="24" stroke="#c8ff00" stroke-width="0.9" opacity="0.35"/>
          <polyline points="25,28 28,31 34,22" stroke="#c8ff00" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </div>
      <div class="feat-title">Export Design PDF</div>
      <p class="feat-desc">Once the customer is happy with their cake, export the full design as a print-ready PDF complete with all specifications, tier dimensions, flavor notes, and the estimated price.</p>
    </div>
  </div>
</section>

<!-- HOW IT WORKS -->
<section id="how">
  <div class="section-label">Process</div>
  <h2 class="section-title">HOW IT<br>WORKS.</h2>
  <div class="steps-grid">
    <div class="step-item">
      <div class="step-num">01</div>
      <div class="step-title">Open Designer</div>
      <p class="step-desc">Launch the 3D design studio in your browser no installation, no plugins. Instantly ready for customer sessions.</p>
    </div>
    <div class="step-item">
      <div class="step-num">02</div>
      <div class="step-title">Build the Cake</div>
      <p class="step-desc">Add tiers, pick flavors, choose frosting, and drag on decorations. Watch the 3D model update in real time.</p>
    </div>
    <div class="step-item">
      <div class="step-num">03</div>
      <div class="step-title">Review & Price</div>
      <p class="step-desc">The auto cost estimator calculates a live total. Adjust anything to fit the customer's budget instantly.</p>
    </div>
    <div class="step-item">
      <div class="step-num">04</div>
      <div class="step-title">Export & Order</div>
      <p class="step-desc">Export the final design as a PDF order sheet and hand it straight to production. Zero miscommunication.</p>
    </div>
  </div>
</section>

<!-- STATS -->
<div class="stats-strip">
  <div class="stats-grid">
    <div class="stat-item"><span class="stat-num">3D</span><div class="stat-label">Real-Time Preview</div></div>
    <div class="stat-item"><span class="stat-num">&lt; 1s</span><div class="stat-label">Price Update Time</div></div>
    <div class="stat-item"><span class="stat-num">∞</span><div class="stat-label">Design Combinations</div></div>
    <div class="stat-item"><span class="stat-num">PDF</span><div class="stat-label">Export Included</div></div>
  </div>
</div>

<!-- BIG QUOTE -->
<section class="big-text-section">
  <p class="big-statement">
    DESIGN<br>
    <em>EVERY TIER</em><br>
    BEFORE IT'S<br>
    <span class="ac">BAKED.</span>
  </p>
  <svg class="geo-decor" width="280" height="280" viewBox="0 0 300 300">
    <g style="animation:spin-slow 22s linear infinite;transform-origin:150px 150px">
      <polygon points="150,18 282,228 18,228" fill="none" stroke="#c8ff00" stroke-width="1"/>
    </g>
    <g style="animation:spin-rev 15s linear infinite;transform-origin:150px 150px">
      <rect x="75" y="75" width="150" height="150" fill="none" stroke="#ff5c1a" stroke-width="1" transform="rotate(45 150 150)"/>
    </g>
    <circle cx="150" cy="150" r="55" fill="none" stroke="#c8ff00" stroke-width="0.5" opacity="0.4"/>
    <circle cx="150" cy="150" r="82" fill="none" stroke="#ff5c1a" stroke-width="0.4" opacity="0.2" stroke-dasharray="3 6"/>
  </svg>
</section>

<!-- PRICING -->
<!-- <section id="pricing">
  <div class="section-label">Pricing</div>
  <h2 class="section-title">ONE PLAN.<br>EVERYTHING INCLUDED.</h2>
  <div class="pricing-card">
    <div class="pricing-name">3D Cake Customization</div>
    <div class="pricing-amount"><sup>₱</sup>1,699</div>
    <div class="pricing-period">per month — cancel anytime</div>
    <hr class="pricing-divider"/>
    <ul class="pricing-list">
      <li>Unlimited 3D cake designs per month</li>
      <li>Real-time 3D preview with full rotation controls</li>
      <li>Drag-and-drop tier, flavor & decoration editor</li>
      <li>Automatic live cost estimator</li>
      <li>Export to print-ready PDF</li>
      <li>Email support included</li>
      <li>Full API access for bakery system integration</li>
      <li>Onboarding within 48 hours</li>
    </ul>
    <button class="btn-pricing-full" onclick="document.getElementById('contact').scrollIntoView({behavior: 'smooth'})"><span>Get Access — ₱1,699/mo →</span></button>
    <p class="pricing-note">No setup fees. No long-term contracts. No hidden charges.</p>
  </div>
</section> -->

<!-- PRICING -->
<section id="pricing">
  <div class="section-label">Pricing</div>
  <h2 class="section-title">
    CHOOSE THE RIGHT<br>PLAN FOR YOUR BUSINESS.
  </h2>

  <div class="pricing-wrapper">
    <div class="pricing-grid">

      <!-- BASIC -->
      <div class="pricing-card">
        <div class="pricing-name">Basic Package</div>

        <div class="pricing-amount">
          <sup>₱</sup>1,499
        </div>

        <div class="pricing-period">/month</div>

        <hr class="pricing-divider"/>

        <ul class="pricing-list">
          <li>Basic 3D cake customization interface</li>
          <li>Limited design elements (shape, color, basic decorations)</li>
          <li>Standard cake templates</li>
          <li>Online order form integration</li>
          <li>Customer support (email/chat assistance)</li>
        </ul>

        <div class="pricing-card-bottom">
          <button class="btn-pricing-full"
            onclick="document.getElementById('contact').scrollIntoView({behavior: 'smooth'})">
            <span>Get Basic Plan →</span>
          </button>
        </div>
      </div>

      <!-- STANDARD -->
      <div class="pricing-card featured-plan">

        <div class="pricing-badge">Most Popular</div>

        <div class="pricing-name">Standard Package</div>

        <div class="pricing-amount">
          <sup>₱</sup>2,499
        </div>

        <div class="pricing-period">/month</div>

        <hr class="pricing-divider"/>

        <ul class="pricing-list">
          <li>Includes all Basic features</li>
          <li>Advanced 3D customization tools</li>
          <li>Expanded design library (themes, toppers, decorations)</li>
          <li>Automated price estimation</li>
          <li>Saved design templates</li>
          <li>Basic analytics (order tracking & sales overview)</li>
        </ul>

        <div class="pricing-card-bottom">
          <button class="btn-pricing-full"
            onclick="document.getElementById('contact').scrollIntoView({behavior: 'smooth'})">
            <span>Get Standard Plan →</span>
          </button>
        </div>
      </div>

      <!-- PREMIUM -->
      <div class="pricing-card">
        <div class="pricing-name">Premium Package</div>

        <div class="pricing-amount">
          <sup>₱</sup>3,999
        </div>

        <div class="pricing-period">/month</div>

        <hr class="pricing-divider"/>

        <ul class="pricing-list">
          <li>Includes all Standard features</li>
          <li>Full 3D customization features</li>
          <li>Complete analytics dashboard</li>
          <li>Priority system support and updates</li>
          <li>Unlimited design storage</li>
          <li>Multi-device and mobile optimization</li>
          <li>Early access to new features</li>
        </ul>

        <div class="pricing-card-bottom">
          <button class="btn-pricing-full"
            onclick="document.getElementById('contact').scrollIntoView({behavior: 'smooth'})">
            <span>Get Premium Plan →</span>
          </button>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- CONTACT -->
<section id="contact">
  <div style="padding:110px 60px 0; background:var(--bg2);">
    <div class="section-label">Contact</div>
    <h2 class="section-title">LET'S<br><span style="color:var(--acid)">TALK.</span></h2>
  </div>
  <div class="contact-body" style="margin-top:60px;">
    <div class="contact-info">
      <div class="section-label">Channels</div>
      <div class="contact-channels">
        <div class="channel-item">
          <div class="channel-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#c8ff00" stroke-width="1.5"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
          </div>
          <div>
            <div class="channel-label">Email</div>
            <div class="channel-value">big.t.technologies.ai@gmail.com</div>
            <div class="channel-sub">We reply within 24 hours</div>
          </div>
        </div>
        <div class="channel-item">
          <div class="channel-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#c8ff00" stroke-width="1.5"><path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
          </div>
          <div>
            <div class="channel-label">Office</div>
            <div class="channel-value">Las Piñas, Metro Manila</div>
            <div class="channel-sub">National Capital Region, Philippines</div>
          </div>
        </div>
      </div>
      <div class="avail-strip">
        <div class="avail-dot"></div>
        <div class="avail-text">All systems <span>online</span> — response &lt; 2hrs</div>
      </div>
    </div>

    <div class="contact-form-wrap">
      <div class="form-title">SEND A<br><span>MESSAGE.</span></div>
      <form id="contactForm" novalidate>
        <div class="form-row">
          <div class="form-field">
            <label class="field-label" for="fname">First Name</label>
            <input class="field-input" type="text" id="fname" placeholder="ex: Juan" required/>
          </div>
          <div class="form-field">
            <label class="field-label" for="lname">Last Name</label>
            <input class="field-input" type="text" id="lname" placeholder="ex: dela Cruz" required/>
          </div>
        </div>
        <div class="form-row" style="margin-bottom:2px;">
          <div class="form-field full">
            <label class="field-label" for="email">Email Address</label>
            <input class="field-input" type="email" id="email" placeholder="ex: juandelacruz@gmail.com" required/>
          </div>
        </div>
        <div class="form-check-group">
          <span class="form-check-label">// Type of Inquiry</span>
          <div class="check-options">
            <label class="check-opt"><input type="radio" name="inquiry" value="demo" checked/><div class="check-box"></div><span class="check-opt-label">Request Demo</span></label>
            <label class="check-opt"><input type="radio" name="inquiry" value="pricing"/><div class="check-box"></div><span class="check-opt-label">Pricing Info</span></label>
            <label class="check-opt"><input type="radio" name="inquiry" value="access"/><div class="check-box"></div><span class="check-opt-label">Get Access</span></label>
            <label class="check-opt"><input type="radio" name="inquiry" value="support"/><div class="check-box"></div><span class="check-opt-label">Support</span></label>
            <label class="check-opt"><input type="radio" name="inquiry" value="other"/><div class="check-box"></div><span class="check-opt-label">Other</span></label>
          </div>
        </div>
        <!-- <div style="margin-bottom:2px; display:flex; flex-direction:column; background:var(--input-bg); border:1px solid var(--border2); transition:border-color 0.3s;" id="msgWrap">
          <label class="field-label" for="message">Message</label>
          <textarea class="field-input" id="message" placeholder="Tell us about your bakery, what you need, or any questions..." required></textarea>
        </div> -->
         <div class="form-row" style="margin-bottom:2px;">
          <div class="form-field full">
            <div style="display:flex; flex-direction:column; background:var(--input-bg); border:1px solid var(--border2); transition:border-color 0.3s;" id="msgWrap">
              <label class="field-label" for="message">Message</label>
              <textarea class="field-input" id="message" placeholder="(Tell us about your bakery, what you need, or any questions...)" required></textarea>
            </div>
          </div>
        </div>
        <div class="form-bottom">
          <p class="form-disclaimer">By submitting, you agree to our Privacy Policy. We never share your data.</p>
          <button type="submit" class="btn-submit"><span>Send Message →</span></button>
        </div>
      </form>
      <div class="form-success" id="formSuccess">
        <svg width="52" height="52" viewBox="0 0 56 56" fill="none"><circle cx="28" cy="28" r="27" stroke="#c8ff00" stroke-width="1.5"/><polyline points="16,28 24,36 40,20" stroke="#c8ff00" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/></svg>
        <div class="success-title">MESSAGE SENT.</div>
        <p class="success-sub">We'll get back to you within 24 hours.<br>Talk soon.</p>
      </div>
    </div>
  </div>
</section>

<?php
$members = [
  ["photo"=>"/member1.png","role"=>"CEO","name"=>"Biendelle Tolentino","tag"=>"Camel lang sapat na"],
  ["photo"=>"/member2.png","role"=>"COO","name"=>"Maverick Ursolino","tag"=>"Anton my loves"],
  ["photo"=>"/member3.png","role"=>"CFO","name"=>"John Michael Rudavites","tag"=>"2k lang"],
  ["photo"=>"/member4.png","role"=>"CTO","name"=>"Mark Bantilan","tag"=>"Parlay"],
  ["photo"=>"/member5.png","role"=>"CIO","name"=>"Macky Dumaraog","tag"=>"MCDO"],
  ["photo"=>"/member6.png","role"=>"CMO","name"=>"Roden Rocamora","tag"=>"Malakas mag ml"],
  ["photo"=>"/member7.png","role"=>"CHRO","name"=>"Ronald Zulueta","tag"=>"Mahilig sa babae"],
  ["photo"=>"/member8.png","role"=>"CISCO","name"=>"Junmari De Guzman","tag"=>"send vid sa"],
];
?>
<section id="team">
  <div class="team-header">
    <div class="section-label">The Team</div>
    <h2 class="section-title">MEET THE<br><span style="color:var(--acid)">BUILDERS.</span></h2>
  </div>
  <div class="team-grid">
    <?php foreach($members as $i => $m): ?>
    <div class="team-card">
      <div class="team-scan"></div>
      <img src="<?= $m['photo'] ?>" alt="<?= $m['name'] ?>"/>
      <div class="team-num">0<?= $i+1 ?></div>
      <div class="team-overlay">
        <div class="team-role"><?= $m['role'] ?></div>
        <div class="team-name"><?= $m['name'] ?></div>
        <div class="team-tag"><?= $m['tag'] ?></div>
      </div>
    </div>
    <?php endforeach; ?>
  </div>
</section>



<!-- FOOTER -->
<footer>
  <div class="footer-brand">BIG T</div>
  <div class="footer-links">
    <a href="#">Privacy</a>
    <a href="#">Terms</a>
    <a href="#">Status</a>
  </div>
  <div class="footer-copy">© 2026 BIG T. All rights reserved.</div>
</footer>

<script>
// ── THEME TOGGLE ──────────────────────────────────
function setTheme(t) {
  document.documentElement.setAttribute('data-theme', t);
  document.getElementById('btnDark').classList.toggle('active', t === 'dark');
  document.getElementById('btnLight').classList.toggle('active', t === 'light');
}

// ── CURSOR ────────────────────────────────────────
const cursor = document.getElementById('cursor');
const ring   = document.getElementById('cursorRing');
let mx=0, my=0, rx=0, ry=0;
document.addEventListener('mousemove', e => { mx=e.clientX; my=e.clientY; });
(function ac(){ cursor.style.left=mx+'px'; cursor.style.top=my+'px'; rx+=(mx-rx)*.12; ry+=(my-ry)*.12; ring.style.left=rx+'px'; ring.style.top=ry+'px'; requestAnimationFrame(ac); })();

// ── HERO TITLE ANIMATION ──────────────────────────
const words = ["DESIGN YOUR","DREAM","CAKE."];
const titleEl = document.getElementById('hero-title');
let delay = 0.4;
words.forEach((word, wi) => {
  const d = document.createElement('div');
  d.className = `word word-${wi+1}`;
  word.split('').forEach(ch => {
    const s = document.createElement('span');
    s.className = 'letter';
    s.textContent = ch === ' ' ? '\u00A0' : ch;
    s.style.animationDelay = delay + 's';
    delay += 0.04;
    d.appendChild(s);
  });
  titleEl.appendChild(d);
  delay += 0.08;
});

// ── MARQUEE ───────────────────────────────────────
const mItems = ["3D CAKE DESIGNER","REAL-TIME PREVIEW","DRAG & DROP TOOLS","COST ESTIMATOR","PDF EXPORT","BAKERY SOFTWARE","INTERACTIVE DESIGN"];
const mEl = document.getElementById('marquee');
let mH = '';
for(let i=0;i<3;i++) mItems.forEach(t => { mH += `<span class="marquee-item"><b>✦</b> ${t} </span>`; });
mEl.innerHTML = mH;

// ── HERO CANVAS ───────────────────────────────────
const hC = document.getElementById('geo-canvas');
const hX = hC.getContext('2d');
let W, H;
function rsz(){ W=hC.width=hC.offsetWidth; H=hC.height=hC.offsetHeight; }
window.addEventListener('resize', rsz); rsz();
const shapes = Array.from({length:18}, () => ({
  x: Math.random()*1400, y: Math.random()*900, size: 25+Math.random()*150,
  speed: 0.08+Math.random()*0.28, angle: Math.random()*Math.PI*2, rot: (Math.random()-.5)*.004,
  type: Math.floor(Math.random()*3), color: Math.random()>.55?'#c8ff00':Math.random()>.5?'#ff5c1a':'#f0ede8',
  alpha: 0.025+Math.random()*.065
}));
function dS(s){ hX.save(); hX.translate(s.x,s.y); hX.rotate(s.angle); hX.strokeStyle=s.color; hX.globalAlpha=s.alpha; hX.lineWidth=1; hX.beginPath(); if(s.type===0){ hX.moveTo(0,-s.size); hX.lineTo(s.size*.866,s.size*.5); hX.lineTo(-s.size*.866,s.size*.5); hX.closePath(); } else if(s.type===1){ hX.rect(-s.size/2,-s.size/2,s.size,s.size); } else { for(let i=0;i<6;i++){ const a=(Math.PI/3)*i; i===0?hX.moveTo(Math.cos(a)*s.size,Math.sin(a)*s.size):hX.lineTo(Math.cos(a)*s.size,Math.sin(a)*s.size); } hX.closePath(); } hX.stroke(); hX.restore(); }
let t=0;
(function aH(){ hX.clearRect(0,0,W,H); t+=.003; shapes.forEach(s=>{ s.x+=Math.cos(s.angle+t)*s.speed; s.y+=Math.sin(s.angle*.5+t)*s.speed*.5; s.angle+=s.rot; if(s.x>W+200)s.x=-200; if(s.x<-200)s.x=W+200; if(s.y>H+200)s.y=-200; if(s.y<-200)s.y=H+200; dS(s); }); requestAnimationFrame(aH); })();

// ── PRODUCT CANVAS ────────────────────────────────
const pc = document.getElementById('prodCanvas');
const pctx = pc.getContext('2d');
let pw, ph;
function rpc(){ pw=pc.width=pc.offsetWidth; ph=pc.height=pc.offsetHeight; }
rpc(); window.addEventListener('resize', rpc);
const pts = Array.from({length:8}, () => ({ x:Math.random()*500, y:Math.random()*500, vx:(Math.random()-.5)*.55, vy:(Math.random()-.5)*.55 }));
let tt=0;
(function ap(){
  pctx.clearRect(0,0,pw,ph); tt+=.007;
  pts.forEach(p=>{ p.x+=p.vx; p.y+=p.vy; if(p.x<0||p.x>pw)p.vx*=-1; if(p.y<0||p.y>ph)p.vy*=-1; });
  for(let a=0;a<pts.length;a++) for(let b=a+1;b<pts.length;b++){
    const dx=pts[a].x-pts[b].x, dy=pts[a].y-pts[b].y, dist=Math.sqrt(dx*dx+dy*dy);
    if(dist<220){ pctx.beginPath(); pctx.strokeStyle='#c8ff00'; pctx.globalAlpha=(1-dist/220)*.22; pctx.lineWidth=.8; pctx.moveTo(pts[a].x,pts[a].y); pctx.lineTo(pts[b].x,pts[b].y); pctx.stroke(); }
  }
  pts.forEach(p=>{ pctx.beginPath(); pctx.arc(p.x,p.y,2.5,0,Math.PI*2); pctx.fillStyle='#c8ff00'; pctx.globalAlpha=.45; pctx.fill(); });
  pctx.save(); pctx.translate(pw/2,ph/2); pctx.rotate(tt*.25); pctx.strokeStyle='#c8ff00'; pctx.globalAlpha=.06; pctx.lineWidth=1;
  pctx.beginPath(); const r2=Math.min(pw,ph)*.28; for(let k=0;k<6;k++){ const a=(Math.PI/3)*k; k===0?pctx.moveTo(Math.cos(a)*r2,Math.sin(a)*r2):pctx.lineTo(Math.cos(a)*r2,Math.sin(a)*r2); } pctx.closePath(); pctx.stroke();
  pctx.rotate(-tt*.4); pctx.globalAlpha=.04;
  pctx.beginPath(); const r3=Math.min(pw,ph)*.18; pctx.rect(-r3,-r3,r3*2,r3*2); pctx.stroke();
  pctx.restore();
  requestAnimationFrame(ap);
})();

// ── FORM VALIDATION ─────────────────────────────────────────
function validateContactForm() {
  let isValid = true;
  
  // Reset previous errors
  const fields = document.querySelectorAll('.form-field, .check-options');
  fields.forEach(field => field.classList.remove('invalid'));
  const errorMessages = document.querySelectorAll('.form-error, .check-error');
  errorMessages.forEach(msg => msg.remove());

  // First name validation
  const fname = document.getElementById('fname');
  if (!fname.value.trim()) {
    addValidationError(fname, 'Please enter your first name');
    isValid = false;
  }

  // Last name validation
  const lname = document.getElementById('lname');
  if (!lname.value.trim()) {
    addValidationError(lname, 'Please enter your last name');
    isValid = false;
  }

  // Email validation
  const email = document.getElementById('email');
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!email.value.trim()) {
    addValidationError(email, 'Please enter your email address');
    isValid = false;
  } else if (!emailRegex.test(email.value)) {
    addValidationError(email, 'Please enter a valid email address');
    isValid = false;
  }

  // Message validation
  const message = document.getElementById('message');
  if (!message.value.trim()) {
    addValidationError(message, 'Please enter your message');
    isValid = false;
  }

  // Inquiry type validation
  const inquiry = document.querySelector('input[name="inquiry"]:checked');
  if (!inquiry) {
    const inquiryGroup = document.querySelector('.check-options');
    const errorDiv = document.createElement('div');
    errorDiv.className = 'check-error';
    errorDiv.textContent = 'Please select an inquiry type';
    inquiryGroup.appendChild(errorDiv);
    isValid = false;
  }

  return isValid;
}

function addValidationError(element, message) {
  const formField = element.closest('.form-field');
  if (formField) {
    formField.classList.add('invalid');
    const label = formField.querySelector('.field-label');
    const errorDiv = document.createElement('div');
    errorDiv.className = 'form-error';
    errorDiv.textContent = message;
    label.parentNode.insertBefore(errorDiv, label.nextSibling);
  }
}

// ── FORM: textarea border ─────────────────────────
const msgWrap = document.getElementById('msgWrap');
const msgTA   = document.getElementById('message');
msgTA.addEventListener('focus', () => { msgWrap.style.borderColor = 'var(--acid)'; });
msgTA.addEventListener('blur',  () => { msgWrap.style.borderColor = 'var(--border2)'; });

// ── FORM SUBMIT → GOOGLE SHEETS ───────────────────
document.getElementById('contactForm').addEventListener('submit', async function(e) {
  if (!validateContactForm()) {
    e.preventDefault();
    return;
  }
  e.preventDefault();
  const form = this;
  const btn  = form.querySelector('.btn-submit');
  btn.querySelector('span').textContent = 'Sending...';
  btn.style.opacity = '0.7';

  const formData = {
    firstName: document.getElementById('fname').value,
    lastName:  document.getElementById('lname').value,
    email:     document.getElementById('email').value,
    // product:   '3D Cake Customization',
    inquiry:   document.querySelector('input[name="inquiry"]:checked').value,
    message:   document.getElementById('message').value
  };

  try {
    await fetch('https://script.google.com/macros/s/AKfycbyvLH0mbYGkdmNLGb0MYRigjBJJjF6nlljdjHuccEu0YyP-7FC8gOf3scFuJCLvxBE/exec', {
      method: 'POST',
      body: JSON.stringify(formData),
    });
    form.style.opacity = '0'; form.style.transition = 'opacity 0.4s';
    setTimeout(() => {
      form.style.display = 'none';
      const s = document.getElementById('formSuccess');
      s.classList.add('show'); s.style.opacity='0'; s.style.transition='opacity 0.5s';
      requestAnimationFrame(()=>{ s.style.opacity='1'; });
    }, 400);
  } catch(err) {
    alert('Failed to send. Please try again.');
    btn.querySelector('span').textContent = 'Send Message →';
    btn.style.opacity = '1';
  }
});


</script>
</body>
</html>