/* ============================================================
   NoctiDev — visual section components
   ============================================================ */
const { useState, useEffect, useRef } = React;

/* ---- helpers ---- */
function renderRich(str) {
  const parts = [];
  let rest = str;
  let key = 0;
  const re = /\*\*(.+?)\*\*|<hl>(.+?)<\/hl>/g;
  let last = 0, m;
  while ((m = re.exec(str)) !== null) {
    if (m.index > last) parts.push(str.slice(last, m.index));
    if (m[1] != null) parts.push(<b key={key++}>{m[1]}</b>);
    else parts.push(<span className="hl" key={key++}>{m[2]}</span>);
    last = re.lastIndex;
  }
  if (last < str.length) parts.push(str.slice(last));
  return parts;
}

function OutHead({ file }) {
  return (
    <div className="out-head">
      <span><span className="dim">cat </span><span className="file">{file}</span></span>
    </div>
  );
}

/* ---- Neofetch ---- */
function Neofetch() {
  const d = window.SITE;
  const n = d.neofetch;
  const swatches = ["--c-red", "--c-green", "--accent", "--c-blue", "--c-purple", "--c-cyan", "--c-orange", "--fg"];
  return (
    <div className="neofetch">
      <pre className="neo-ascii">{d.ascii}</pre>
      <div className="neo-info">
        <div className="neo-title">
          <span className="name glow">{n.titleName}</span>
          <span className="at">@</span>
          <span className="host glow">{n.titleHost}</span>
        </div>
        <div className="neo-rule">───────────────────</div>
        {n.rows.map(([k, v], i) => (
          <div className="neo-row" key={i}>
            <span className="k">{k}</span>
            <span className="v">
              {Array.isArray(v)
                ? v.map((x, j) => (
                    <React.Fragment key={j}>
                      {j > 0 && <span className="sep">·</span>}{x}
                    </React.Fragment>
                  ))
                : v}
            </span>
          </div>
        ))}
        <div className="neo-palette">
          {swatches.map((c, i) => (
            <span className="neo-sw" key={i} style={{ background: `var(${c})` }} />
          ))}
        </div>
      </div>
    </div>
  );
}

/* ---- About ---- */
function About() {
  const a = window.SITE.about;
  return (
    <div className="out about">
      <OutHead file="about.md" />
      <p className="lead">{renderRich(a.lead)}</p>
      <div className="meta">
        {a.meta.map(([k, v, acc], i) => (
          <div className="cell" key={i}>
            <span className="k">{k}</span>
            <span className={"v" + (acc ? " acc" : "")}>{v}</span>
          </div>
        ))}
      </div>
    </div>
  );
}

/* ---- Projects ---- */
function Projects() {
  const ps = window.SITE.projects;
  return (
    <div className="out">
      <div className="out-head">
        <span><span className="dim">ls </span><span className="file">~/projects</span><span className="dim"> --sort=stars</span></span>
      </div>
      <div className="projects">
        {ps.map((p, i) => (
          <a className="proj" key={i} href={p.url} style={{ "--lang": p.color }}
             target={p.url !== "#" ? "_blank" : undefined} rel="noreferrer">
            <div className="top">
              <span className="pname"><span className="slash">noctidev/</span>{p.name}</span>
              <span className="badge">{p.lang}</span>
              <span className="spacer" />
              <span className="stars"><span className="s">★</span>{p.stars.toLocaleString()}</span>
            </div>
            <div className="desc">{p.desc}</div>
            <div className="tags">
              {p.tags.map((t, j) => <span className="tag" key={j}>{t}</span>)}
            </div>
          </a>
        ))}
      </div>
    </div>
  );
}

/* ---- Skills ---- */
function bar(level) {
  const total = 14;
  const filled = Math.round((level / 5) * total);
  return { on: "█".repeat(filled), off: "░".repeat(total - filled) };
}
function Skills() {
  const groups = window.SITE.skills;
  return (
    <div className="out">
      <div className="out-head">
        <span><span className="dim">cat </span><span className="file">skills.toml</span></span>
      </div>
      <div className="skills">
        {groups.map((g, i) => (
          <div className="skgroup" key={i}>
            <div className="skgroup-h">{g.group}</div>
            {g.items.map((s, j) => {
              const b = bar(s[1]);
              return (
                <div className="skill" key={j}>
                  <div className="row">
                    <span className="nm">{s[0]}</span>
                    <span className="lv">{s[2]}</span>
                  </div>
                  <div className="bar"><span className="fill">{b.on}</span>{b.off}</div>
                </div>
              );
            })}
          </div>
        ))}
      </div>
    </div>
  );
}

/* ---- Experience ---- */
function Experience() {
  const xs = window.SITE.experience;
  return (
    <div className="out">
      <div className="out-head">
        <span><span className="dim">git log </span><span className="file">--oneline --career</span></span>
      </div>
      <div className="exp">
        {xs.map((x, i) => (
          <div className="commit" key={i}>
            <span className="hash">commit {x.hash}</span>
            <div className="role">{x.role} <span className="co">{x.company}</span></div>
            <div className="when">{x.when}</div>
            <ul className="what">
              {x.what.map((w, j) => <li key={j}>{w}</li>)}
            </ul>
            <div className="stack">
              {x.stack.map((t, j) => <span className="t" key={j}>{t}</span>)}
            </div>
          </div>
        ))}
      </div>
    </div>
  );
}

/* ---- Social / contact ---- */
function Social() {
  const ls = window.SITE.links;
  return (
    <div className="out txt">
      {ls.map(([k, v, href], i) => (
        <div className="neo-row" key={i} style={{ marginBottom: 4 }}>
          <span className="k" style={{ minWidth: 80 }}>{k}</span>
          <span className="v">
            <a href={href} className="accent" style={{ textDecoration: "none" }}
               target={href !== "#" ? "_blank" : undefined} rel="noreferrer">{v}</a>
          </span>
        </div>
      ))}
    </div>
  );
}

/* ---- Help ---- */
const COMMANDS = [
  ["about",      "quién soy"],
  ["projects",   "repos destacados"],
  ["skills",     "stack & nivel"],
  ["experience", "trayectoria (git log)"],
  ["social",     "dónde encontrarme"],
  ["neofetch",   "re-imprime la cabecera"],
  ["theme",      "cambia el color scheme"],
  ["help",       "esta ayuda"],
  ["clear",      "limpia la terminal"],
];
function Help() {
  return (
    <div className="out helptbl">
      <div style={{ marginBottom: 8 }} className="dim">comandos disponibles —</div>
      {COMMANDS.map(([c, d], i) => (
        <div className="hrow" key={i}>
          <span className="c1">{c}</span>
          <span className="c2">{d}</span>
        </div>
      ))}
    </div>
  );
}

Object.assign(window, {
  Neofetch, About, Projects, Skills, Experience, Social, Help, COMMANDS,
});
