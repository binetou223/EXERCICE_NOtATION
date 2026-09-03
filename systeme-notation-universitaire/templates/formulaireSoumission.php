<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Formulaire de Soumission</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,400;0,9..144,600;1,9..144,500&family=IBM+Plex+Sans:wght@400;500;600&display=swap" rel="stylesheet">
<style>
  * { margin: 0; padding: 0; box-sizing: border-box; }

  :root {
    --ink: #2A1B10;
    --espresso: #3E2A19;
    --espresso-2: #563A22;
    --clay: #A6702E;
    --clay-dark: #8A5A24;
    --gold: #C9A15C;
    --parchment: #FBF3E7;
    --parchment-line: #E5D6BC;
    --paper: #FFFDF8;
    --error: #B0492E;
  }

  html, body {
    height: 100%;
    width: 100%;
    overflow: hidden;
  }

  body {
    font-family: 'IBM Plex Sans', sans-serif;
    color: var(--ink);
    background: var(--parchment);
  }

  .page {
    display: grid;
    grid-template-columns: 42% 58%;
    height: 100vh;
    height: 100dvh;
    width: 100vw;
  }

  /* ============================================
     PANNEAU GAUCHE — ILLUSTRATION
     ============================================ */
  .visual-panel {
    position: relative;
    background:
      linear-gradient(165deg, var(--espresso) 0%, var(--espresso-2) 100%);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding: 5.5vh 4.5vw;
    overflow: hidden;
  }

  /* ligne de cahier en filigrane, en écho au thème "notes" */
  .visual-panel::before {
    content: '';
    position: absolute;
    inset: 0;
    background-image: repeating-linear-gradient(
      to bottom,
      transparent 0,
      transparent 63px,
      rgba(251, 243, 231, 0.05) 64px
    );
    pointer-events: none;
  }

  .watermark {
    position: absolute;
    right: -6%;
    bottom: -10%;
    font-family: 'Fraunces', serif;
    font-size: 46vh;
    font-weight: 600;
    color: rgba(251, 243, 231, 0.045);
    line-height: 1;
    user-select: none;
    pointer-events: none;
  }

  .visual-top {
    position: relative;
    z-index: 1;
  }

  .eyebrow-mark {
    display: flex;
    align-items: center;
    gap: 10px;
    color: var(--gold);
    font-size: 0.8rem;
    letter-spacing: 0.01em;
    margin-bottom: 28px;
  }

  .eyebrow-mark .dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: var(--gold);
  }

  .visual-title {
    font-family: 'Fraunces', serif;
    font-weight: 600;
    font-size: clamp(2.2rem, 4vw, 3.2rem);
    line-height: 1.08;
    color: var(--paper);
    letter-spacing: -0.01em;
    max-width: 9ch;
  }

  .visual-subtitle {
    margin-top: 20px;
    font-size: 1rem;
    line-height: 1.65;
    color: rgba(251, 243, 231, 0.7);
    max-width: 32ch;
  }

  /* Illustration : dossier + tampon */
  .illustration {
    position: relative;
    z-index: 1;
    width: 100%;
    max-width: 340px;
    align-self: center;
    margin: 4vh auto;
  }

  .stamp-group {
    transform-origin: 68% 32%;
    animation: stampPress 1.1s cubic-bezier(.34,1.56,.64,1) 0.35s both;
  }

  @keyframes stampPress {
    0%   { transform: scale(1.9) rotate(-14deg); opacity: 0; }
    55%  { transform: scale(0.92) rotate(-6deg); opacity: 1; }
    75%  { transform: scale(1.06) rotate(-6deg); }
    100% { transform: scale(1) rotate(-6deg); opacity: 1; }
  }

  .visual-footer {
    position: relative;
    z-index: 1;
    display: flex;
    align-items: baseline;
    gap: 10px;
    color: rgba(251, 243, 231, 0.5);
    font-size: 0.82rem;
  }

  .visual-footer strong {
    color: var(--gold);
    font-weight: 600;
  }

  /* ============================================
     PANNEAU DROIT — FORMULAIRE
     ============================================ */
  .form-panel {
    background: var(--parchment);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 5vh 6vw;
    overflow-y: auto;
  }

  .form-inner {
    width: 100%;
    max-width: 440px;
  }

  .form-header {
    margin-bottom: 44px;
  }

  .form-title {
    font-family: 'Fraunces', serif;
    font-weight: 600;
    font-size: 2rem;
    color: var(--ink);
    letter-spacing: -0.01em;
    margin-bottom: 10px;
  }

  .form-description {
    font-size: 0.95rem;
    color: #7A5F42;
    line-height: 1.55;
    max-width: 40ch;
  }

  form {
    display: flex;
    flex-direction: column;
    gap: 26px;
  }

  .field-label {
    display: block;
    font-size: 0.82rem;
    font-weight: 500;
    color: var(--espresso-2);
    margin-bottom: 9px;
  }

  .field-label .required {
    color: var(--error);
    margin-left: 3px;
  }

  .input-wrapper {
    position: relative;
  }

  .field-input {
    width: 100%;
    padding: 14px 16px;
    font-size: 1rem;
    font-family: inherit;
    color: var(--ink);
    background: var(--paper);
    border: 1.5px solid var(--parchment-line);
    border-radius: 8px;
    transition: border-color 0.2s ease, box-shadow 0.2s ease;
    outline: none;
  }

  .field-input:hover {
    border-color: var(--clay);
  }

  .field-input:focus {
    border-color: var(--clay-dark);
    box-shadow: 0 0 0 3px rgba(166, 112, 46, 0.14);
  }

  .field-input::placeholder {
    color: #C4AF92;
  }

  .note-field {
    padding-right: 56px;
    font-family: 'Fraunces', serif;
    font-size: 1.2rem;
    font-weight: 500;
  }

  .note-suffix {
    position: absolute;
    right: 16px;
    top: 50%;
    transform: translateY(-50%);
    color: #9C7E56;
    font-family: 'Fraunces', serif;
    font-weight: 500;
    font-size: 1.05rem;
    pointer-events: none;
  }

  .date-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 18px;
  }

  @media (max-width: 640px) {
    .date-row { grid-template-columns: 1fr; }
  }

  .form-actions {
    display: flex;
    gap: 12px;
    margin-top: 10px;
  }

  .btn {
    flex: 1;
    padding: 14px 22px;
    font-size: 0.92rem;
    font-weight: 600;
    font-family: inherit;
    border-radius: 8px;
    cursor: pointer;
    transition: transform 0.15s ease, box-shadow 0.2s ease, background 0.2s ease;
  }

  .btn-primary {
    background: linear-gradient(135deg, var(--clay) 0%, var(--clay-dark) 100%);
    color: var(--paper);
    border: none;
    box-shadow: 0 4px 14px rgba(138, 90, 36, 0.35);
  }

  .btn-primary:hover {
    transform: translateY(-1px);
    box-shadow: 0 6px 18px rgba(138, 90, 36, 0.45);
  }

  .btn-secondary {
    background: transparent;
    color: var(--espresso-2);
    border: 1.5px solid var(--parchment-line);
  }

  .btn-secondary:hover {
    border-color: var(--clay);
    color: var(--clay-dark);
  }

  /* ============================================
     RESPONSIVE
     ============================================ */
  @media (max-width: 860px) {
    html, body { overflow: auto; }
    .page {
      grid-template-columns: 1fr;
      height: auto;
      min-height: 100dvh;
    }
    .visual-panel {
      padding: 6vh 8vw;
      min-height: 42vh;
    }
    .illustration { max-width: 220px; margin: 3vh auto; }
    .visual-title { max-width: none; }
    .form-panel { padding: 6vh 8vw; }
  }

  @media (prefers-reduced-motion: reduce) {
    .stamp-group { animation: none; }
  }
</style>
</head>
<body>
  <div class="page">

    <!-- PANNEAU GAUCHE -->
    <div class="visual-panel">
      <span class="watermark">20</span>

      <div class="visual-top">
        <div class="eyebrow-mark"><span class="dot"></span> Gestion des notes</div>
        <h1 class="visual-title">Votre dépôt, archivé avec soin</h1>
        <p class="visual-subtitle">Enregistrez l'évaluation et les dates clés de votre soumission avant la fermeture du dossier.</p>
      </div>

      <svg class="illustration" viewBox="0 0 320 260" fill="none" xmlns="http://www.w3.org/2000/svg">
        <!-- dossier arrière -->
        <path d="M40 90 L40 200 Q40 208 48 208 L272 208 Q280 208 280 200 L280 110 Q280 102 272 102 L170 102 L156 84 Q152 78 144 78 L48 78 Q40 78 40 86 Z" fill="#2F2013" stroke="#5A3E24" stroke-width="1.5"/>
        <!-- feuille sortante -->
        <rect x="70" y="52" width="150" height="118" rx="4" fill="#FBF3E7" stroke="#E5D6BC" stroke-width="1.5" transform="rotate(-4 145 111)"/>
        <g transform="rotate(-4 145 111)">
          <rect x="86" y="70" width="88" height="6" rx="3" fill="#C9A15C" opacity="0.55"/>
          <rect x="86" y="86" width="118" height="4" rx="2" fill="#D8C6A6"/>
          <rect x="86" y="98" width="118" height="4" rx="2" fill="#D8C6A6"/>
          <rect x="86" y="110" width="70" height="4" rx="2" fill="#D8C6A6"/>
          <rect x="86" y="132" width="52" height="4" rx="2" fill="#D8C6A6"/>
          <rect x="86" y="144" width="70" height="4" rx="2" fill="#D8C6A6"/>
        </g>
        <!-- dossier avant -->
        <path d="M32 118 Q32 108 42 108 L268 108 Q280 108 277 120 L256 206 Q253 216 243 216 L54 216 Q44 216 41 206 Z" fill="#47301D" stroke="#6B4B2A" stroke-width="1.5"/>
        <!-- tampon -->
        <g class="stamp-group">
          <circle cx="228" cy="150" r="46" fill="none" stroke="#C9A15C" stroke-width="4"/>
          <circle cx="228" cy="150" r="35" fill="none" stroke="#C9A15C" stroke-width="1.5"/>
          <path d="M210 150 L222 162 L248 134" stroke="#C9A15C" stroke-width="5" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
        </g>
      </svg>

      <div class="visual-footer">Dossier ouvert pour <strong>soumission active</strong></div>
    </div>

    <!-- PANNEAU DROIT -->
    <div class="form-panel">
      <div class="form-inner">
        <div class="form-header">
          <h2 class="form-title">Formulaire de soumission</h2>
          <p class="form-description">Remplissez les informations ci-dessous pour enregistrer votre soumission.</p>
        </div>

        <form>
          <div class="form-group">
            <label class="field-label" for="noteBrute">Note brute<span class="required">*</span></label>
            <div class="input-wrapper">
              <input type="number" id="noteBrute" name="noteBrute" class="field-input note-field" placeholder="0.00" min="0" max="20" step="0.01" required>
              <span class="note-suffix">/ 20</span>
            </div>
          </div>

          <div class="date-row">
            <div class="form-group">
              <label class="field-label" for="dateDepot">Date de dépôt<span class="required">*</span></label>
              <input type="datetime-local" id="dateDepot" name="dateDepot" class="field-input" required>
            </div>

            <div class="form-group">
              <label class="field-label" for="dateLimite">Date limite<span class="required">*</span></label>
              <input type="datetime-local" id="dateLimite" name="dateLimite" class="field-input" required>
            </div>
          </div>

          <div class="form-actions">
            <button type="button" class="btn btn-secondary">Annuler</button>
            <button type="submit" class="btn btn-primary">Soumettre</button>
          </div>
        </form>
      </div>
    </div>

  </div>
</body>
</html>