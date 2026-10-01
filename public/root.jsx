/* ============================================================
   NoctiDev — root app: theme application + Tweaks panel
   ============================================================ */
function App() {
  const [t, setTweak] = useTweaks(window.TWEAK_DEFAULTS);

  // Bridge for standalone mode: relay dismissed → deactivate so the panel hides
  React.useEffect(() => {
    const handle = (e) => {
      if (e.data?.type === '__edit_mode_dismissed') {
        window.postMessage({ type: '__deactivate_edit_mode' }, '*');
      }
    };
    window.addEventListener('message', handle);
    return () => window.removeEventListener('message', handle);
  }, []);

  const openTweaks = () => window.postMessage({ type: '__activate_edit_mode' }, '*');

  React.useEffect(() => {
    const root = document.documentElement;
    root.setAttribute("data-theme", t.theme);
    document.body.dataset.mono = t.theme === "greencrt" ? "1" : "0";
    document.body.classList.toggle("crt-scan", !!t.scanlines);
    document.body.classList.toggle("crt-glow", !!t.glow);
    document.body.classList.toggle("crt-flicker", !!t.flicker);
    document.body.classList.toggle("no-liga", !t.ligatures);
  }, [t.theme, t.scanlines, t.glow, t.flicker, t.ligatures]);

  return (
    <React.Fragment>
      <Terminal theme={t.theme} setTweak={setTweak} onOpenTweaks={openTweaks} />
      <TweaksPanel title="Tweaks">
        <TweakSection label="Color scheme" />
        <TweakSelect
          label="Theme"
          value={t.theme}
          options={window.THEME_ORDER.map((k) => ({ value: k, label: window.THEME_LABEL[k] }))}
          onChange={(v) => setTweak("theme", v)}
        />
        <TweakSection label="CRT effects" />
        <TweakToggle label="Scanlines" value={t.scanlines} onChange={(v) => setTweak("scanlines", v)} />
        <TweakToggle label="Screen glow / vignette" value={t.glow} onChange={(v) => setTweak("glow", v)} />
        <TweakToggle label="Flicker" value={t.flicker} onChange={(v) => setTweak("flicker", v)} />
        <TweakSection label="Type" />
        <TweakToggle label="Font ligatures" value={t.ligatures} onChange={(v) => setTweak("ligatures", v)} />
      </TweaksPanel>
    </React.Fragment>
  );
}

ReactDOM.createRoot(document.getElementById("root")).render(<App />);
