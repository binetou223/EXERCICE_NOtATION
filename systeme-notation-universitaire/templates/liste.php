<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Liste des soumissions</title>
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
    --good: #3A6B2A;
    --good-bg: #E8F5E2;
    --bad: #8B3A21;
    --bad-bg: #FDE8E2;
  }

  html, body { height: 100%; width: 100%; }

  body {
    font-family: 'IBM Plex Sans', sans-serif;
    color: var(--ink);
    background: var(--parchment);
  }

  .page {
    display: grid;
    grid-template-columns: 36% 64%;
    min-height: 100vh;
    min-height: 100dvh;
    width: 100vw;
  }

  /* ============================================
     PANNEAU GAUCHE — VISUEL
     ============================================ */
  .visual-panel {
    position: relative;
    background: linear-gradient(165deg, var(--espresso) 0%, var(--espresso-2) 100%);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding: 5.5vh 3.5vw;
    overflow: hidden;
  }

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
    right: -8%;
    bottom: -8%;
    font-family: 'Fraunces', serif;
    font-size: 42vh;
    font-weight: 600;
    color: rgba(251, 243, 231, 0.045);
    line-height: 1;
    user-select: none;
    pointer-events: none;
  }

  .visual-top { position: relative; z-index: 1; }

  .eyebrow-mark {
    display: flex;
    align-items: center;
    gap: 10px;
    color: var(--gold);
    font-size: 0.8rem;
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
    font-size: clamp(2rem, 3.4vw, 2.8rem);
    line-height: 1.1;
    color: var(--paper);
    letter-spacing: -0.01em;
    max-width: 10ch;
  }

  .visual-subtitle {
    margin-top: 18px;
    font-size: 0.98rem;
    line-height: 1.6;
    color: rgba(251, 243, 231, 0.7);
    max-width: 30ch;
  }

  /* cartes de synthèse — chiffres réels du registre, pas une décoration générique */
  .stats {
    position: relative;
    z-index: 1;
    display: flex;
    flex-direction: column;
    gap: 14px;
  }

  .stat-row {
    display: flex;
    align-items: baseline;
    justify-content: space-between;
    padding: 16px 0;
    border-top: 1px solid rgba(251, 243, 231, 0.14);
  }

  .stat-row:last-child {
    border-bottom: 1px solid rgba(251, 243, 231, 0.14);
  }

  .stat-label {
    font-size: 0.82rem;
    color: rgba(251, 243, 231, 0.62);
  }

  .stat-value {
    font-family: 'Fraunces', serif;
    font-size: 1.5rem;
    font-weight: 600;
    color: var(--gold);
  }

  .visual-footer {
    position: relative;
    z-index: 1;
    color: rgba(251, 243, 231, 0.5);
    font-size: 0.82rem;
  }

  .visual-footer strong { color: var(--gold); font-weight: 600; }

  /* ============================================
     PANNEAU DROIT — LISTE
     ============================================ */
  .list-panel {
    background: var(--parchment);
    padding: 5.5vh 4.5vw;
    overflow-y: auto;
    display: flex;
    flex-direction: column;
  }

  .list-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    gap: 20px;
    margin-bottom: 30px;
  }

  .list-title {
    font-family: 'Fraunces', serif;
    font-weight: 600;
    font-size: 1.9rem;
    color: var(--ink);
    letter-spacing: -0.01em;
    margin-bottom: 8px;
  }

  .list-description {
    font-size: 0.94rem;
    color: #7A5F42;
    line-height: 1.5;
    max-width: 42ch;
  }

  /* ============================================
     TABLEAU
     ============================================ */
  .table-wrapper {
    background: var(--paper);
    border: 1.5px solid var(--parchment-line);
    border-radius: 10px;
    overflow: hidden;
  }

  table { width: 100%; border-collapse: collapse; }

  thead { background: linear-gradient(135deg, var(--espresso) 0%, var(--espresso-2) 100%); }

  thead th {
    padding: 15px 18px;
    font-size: 0.75rem;
    font-weight: 500;
    letter-spacing: 0.04em;
    color: rgba(251, 243, 231, 0.85);
    text-align: left;
    white-space: nowrap;
  }

  tbody tr { transition: background 0.15s ease; }
  tbody tr:hover { background: var(--parchment); }
  tbody tr:not(:last-child) td { border-bottom: 1px solid var(--parchment-line); }

  tbody td {
    padding: 15px 18px;
    font-size: 0.92rem;
    color: var(--ink);
    white-space: nowrap;
  }

  .id-badge {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 30px;
    height: 30px;
    background: var(--parchment);
    color: var(--clay-dark);
    border-radius: 7px;
    font-weight: 600;
    font-size: 0.82rem;
    border: 1px solid var(--parchment-line);
  }

  .cell-note {
    font-family: 'Fraunces', serif;
    font-weight: 500;
    font-size: 1.02rem;
    color: var(--espresso-2);
  }

  .note-bar { display: flex; align-items: center; gap: 10px; }

  .note-track {
    width: 56px;
    height: 5px;
    background: var(--parchment-line);
    border-radius: 3px;
    overflow: hidden;
  }

  .note-fill {
    height: 100%;
    background: linear-gradient(90deg, var(--clay), var(--clay-dark));
    border-radius: 3px;
  }

  .penalty-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 0.78rem;
    font-weight: 600;
  }

  .penalty-no { background: var(--good-bg); color: var(--good); }
  .penalty-yes { background: var(--bad-bg); color: var(--bad); }

  .penalty-dot { width: 6px; height: 6px; border-radius: 50%; }
  .penalty-no .penalty-dot { background: var(--good); }
  .penalty-yes .penalty-dot { background: var(--bad); }

  .cell-date { color: var(--espresso-2); }
  .date-main { font-weight: 600; display: block; font-size: 0.88rem; }
  .date-time { font-size: 0.76rem; color: #9C7E56; font-weight: 400; }

  /* ============================================
     RESPONSIVE
     ============================================ */
  @media (max-width: 900px) {
    .page { grid-template-columns: 1fr; min-height: auto; }
    .visual-panel { padding: 6vh 8vw; min-height: 34vh; }
    .visual-title { max-width: none; }
    .stats { flex-direction: row; margin-top: 24px; }
    .stat-row { flex: 1; flex-direction: column; gap: 4px; border: none; padding: 0; text-align: center; }
    .list-panel { padding: 6vh 8vw; }
    .list-header { flex-direction: column; align-items: flex-start; }
    .table-wrapper { overflow-x: auto; }
    thead th, tbody td { padding: 12px 14px; font-size: 0.82rem; }
    .note-track { display: none; }
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
        <h1 class="visual-title">Le registre des soumissions</h1>
        <p class="visual-subtitle">Toutes les évaluations enregistrées, leurs pénalités et leurs échéances, réunies au même endroit.</p>
      </div>

      <div class="stats">
        <div class="stat-row">
          <span class="stat-label">Soumissions</span>
          <span class="stat-value">1</span>
        </div>
        <div class="stat-row">
          <span class="stat-label">Moyenne</span>
          <span class="stat-value">15,0 / 20</span>
        </div>
      </div>

      <div class="visual-footer">Dossier ouvert pour <strong>soumission active</strong></div>
    </div>

    <!-- PANNEAU DROIT -->
    <div class="list-panel">
      <div class="list-header">
        <div>
          <h2 class="list-title">Liste des soumissions</h2>
          <p class="list-description">Récapitulatif des notes, pénalités et dates de dépôt.</p>
        </div>
      </div>

      <div class="table-wrapper">
        <table>
          <thead>
            <tr>
              <th>Identifiant</th>
              <th>Note brute</th>
              <th>Note finale</th>
              <th>Pénalité</th>
              <th>Date de dépôt</th>
              <th>Date limite</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td><span class="id-badge">1</span></td>
              <td>
                <div class="note-bar">
                  <span class="cell-note">15,00</span>
                  <div class="note-track"><div class="note-fill" style="width: 75%;"></div></div>
                </div>
              </td>
              <td>
                <div class="note-bar">
                  <span class="cell-note">15,00</span>
                  <div class="note-track"><div class="note-fill" style="width: 75%;"></div></div>
                </div>
              </td>
              <td>
                <span class="penalty-badge penalty-no">
                  <span class="penalty-dot"></span> Non
                </span>
              </td>
              <td class="cell-date">
                <span class="date-main">03/09/2026</span>
                <span class="date-time">10:00</span>
              </td>
              <td class="cell-date">
                <span class="date-main">03/09/2026</span>
                <span class="date-time">12:00</span>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

  </div>
</body>
</html>