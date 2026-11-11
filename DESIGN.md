---
name: WhirlStudio Hamburg (design "impeccable")
description: Bright private-spa standard at boutique-hotel level; photo first, white and cool grey, one LED-blue accent.
colors:
  led-blue: "#2338c9"
  led-blue-deep: "#1a2a9c"
  periwinkle-on-navy: "#9fb2ff"
  paper-white: "#ffffff"
  cool-mist: "#f3f4f7"
  ink-navy: "#14172b"
  slate-ink: "#535872"
  hairline: "#e2e4ec"
  navy-ink-light: "#f5f6fa"
  navy-soft: "#b9bdd0"
  navy-line: "#2c3150"
typography:
  display:
    fontFamily: "'Bodoni Moda', 'Didot', Georgia, serif"
    fontSize: "clamp(2.75rem, 6.2vw, 5.75rem)"
    fontWeight: 400
    lineHeight: 1.04
    letterSpacing: "-0.012em"
  headline:
    fontFamily: "'Bodoni Moda', 'Didot', Georgia, serif"
    fontSize: "clamp(2rem, 3.6vw, 3.25rem)"
    fontWeight: 400
    lineHeight: 1.04
    letterSpacing: "-0.012em"
  title:
    fontFamily: "'Hanken Grotesk', system-ui, -apple-system, 'Segoe UI', sans-serif"
    fontSize: "1.0625rem"
    fontWeight: 600
    lineHeight: 1.35
    letterSpacing: "0em"
  lead:
    fontFamily: "'Hanken Grotesk', system-ui, -apple-system, 'Segoe UI', sans-serif"
    fontSize: "1.375rem"
    fontWeight: 400
    lineHeight: 1.45
  body:
    fontFamily: "'Hanken Grotesk', system-ui, -apple-system, 'Segoe UI', sans-serif"
    fontSize: "1.0625rem"
    fontWeight: 400
    lineHeight: 1.65
  label:
    fontFamily: "'Hanken Grotesk', system-ui, -apple-system, 'Segoe UI', sans-serif"
    fontSize: "0.875rem"
    fontWeight: 600
    lineHeight: 1.4
    letterSpacing: "0.06em"
rounded:
  s: "4px"
  r: "6px"
  pill: "999px"
spacing:
  photo-gap: "8px"
  strip-gap: "4px"
  gutter: "clamp(16px, 4vw, 40px)"
  section: "clamp(80px, 10vw, 152px)"
  wrap: "1240px"
components:
  button-primary:
    backgroundColor: "{colors.led-blue}"
    textColor: "{colors.paper-white}"
    typography: "{typography.label}"
    rounded: "{rounded.s}"
    padding: "0 30px"
    height: "52px"
  button-primary-hover:
    backgroundColor: "{colors.led-blue-deep}"
  button-line:
    backgroundColor: "transparent"
    textColor: "{colors.ink-navy}"
    rounded: "{rounded.s}"
    padding: "0 30px"
    height: "52px"
  button-line-hover:
    backgroundColor: "{colors.ink-navy}"
    textColor: "{colors.paper-white}"
  button-small:
    padding: "0 20px"
    height: "44px"
  chip:
    backgroundColor: "transparent"
    textColor: "{colors.ink-navy}"
    rounded: "{rounded.pill}"
    padding: "6px 14px"
  price-card:
    backgroundColor: "{colors.paper-white}"
    textColor: "{colors.ink-navy}"
    rounded: "{rounded.r}"
    padding: "clamp(28px, 4vw, 48px)"
  studio-card:
    textColor: "{colors.paper-white}"
    rounded: "{rounded.r}"
    padding: "clamp(24px, 3vw, 40px)"
  footer:
    backgroundColor: "{colors.ink-navy}"
    textColor: "{colors.navy-ink-light}"
---

# Design System: WhirlStudio Hamburg (design "impeccable")

> **Scope.** This file documents the test design **"impeccable"** only: it renders at `?design=impeccable` (body class `d-impeccable`) while `DESIGN_SWITCH` is on. The theme `public/assets/css/theme-impeccable.css` layers on `public/assets/css/base.css`, which owns structure, components and the token names (`--bg`, `--ink`, `--accent`, `--fs-1` … `--fs-s`, `--r`, `--r-s`, `--sec`); it does not load `layout-ed.css`. The live default remains **"bunt"** (`theme-bunt.css`) until the user changes `DEFAULT_DESIGN` in `public/inc/bootstrap.php`. Bunt and the layout-ed test designs are not described here.

## Overview

**Creative North Star: "The Boutique Hotel Brochure"**

The category standard for a bright private spa, chosen on purpose and executed at the level of a boutique-hotel website: the real studio photo comes first, then calm white and cool-grey bands, high-contrast Didone headlines and a matter-of-fact grotesk for everything that has to be read. The only colour that is not a neutral is the LED blue of the whirlpools, lifted from the photographs and reserved for what the visitor can do (buttons, links) and for numerals.

Density is low and the rhythm is generous: full-bleed sections of up to 152px vertical padding alternate white and grey, content sits in a 1240px wrap, and structure is drawn with 1px hairlines instead of tinted tiles. Depth is almost absent; photos with a dark scrim carry all the drama. Motion is slow and singular: the PRETTY/VIBE studio cards zoom gently on hover, and nothing else performs.

**Key Characteristics:**
- Photo first: full-viewport hero photo with centered Didone headline and a hairline fact row.
- Two surfaces only (white, cool grey) plus navy for the footer.
- One accent, LED blue, for actions and numerals only.
- Hairlines instead of boxes; boxes only for price cards and booking info.
- Small, consistent corners (4px controls, 6px containers).
- Flat: no shadows except the mobile booking bar.

## Colors

A cool, near-monochrome palette of white, mist grey and blue-black ink, punctured by a single saturated LED blue.

### Primary
- **LED Blue** (led-blue): primary button fill, text links (`.link`, `.link-u`), step numerals, feature check icons, text selection. White on it reaches 8.5:1.
- **Deep LED Blue** (led-blue-deep): hover state of primary buttons and slider buttons only.
- **Periwinkle on Navy** (periwinkle-on-navy): link and hover colour inside the navy footer, where LED blue would lack contrast. Nowhere else.

### Neutral
- **Paper White** (paper-white): page ground, intro, groups band, "Alles für eure Auszeit" band, price card fill, scrolled header (at 97% opacity).
- **Cool Mist** (cool-mist): the second surface; couples band, studios band, prices band, FAQ and directions.
- **Ink Navy** (ink-navy): all text, the line-button border and its hover fill, the strong 1px rules above perks, USPs and reasons; also the footer ground.
- **Slate Ink** (slate-ink): secondary text, leads, labels.
- **Hairline** (hairline): every divider, card border, chip outline and FAQ rule.
- **Navy Ink Light / Navy Soft / Navy Line** (navy-ink-light, navy-soft, navy-line): text, secondary text and rules on the navy footer.

Photo scrims are tints of the ink (rgba(10,12,30,…)), never coloured gradients. The Booking.com score badge keeps Booking's own navy and star yellow from base.css; that is a borrowed trust mark, not part of the palette.

### Named Rules
**The Lit Pool Rule.** LED blue appears only on things you can press and on numbers (step numerals). It never fills a surface, tints a section or colours a label.

**The Two Surfaces Rule.** Sections alternate Paper White and Cool Mist; the legacy surface variables (lilac, sun, teal) are aliased to these two. A third light surface is not part of this world. The "dark" studios section renders on Cool Mist by user request ("not too dark"); navy is kept for the footer.

## Typography

**Display Font:** Bodoni Moda (with Didot, Georgia, serif), local woff2, regular and italic
**Body Font:** Hanken Grotesk (with system-ui, Segoe UI, sans-serif), local woff2, 400/500/600

**Character:** A hairline-and-thick Didone gives the headlines hotel-lobby poise; Hanken Grotesk keeps prices, times and rules plain and legible.

### Hierarchy
- **Display** (400, `--fs-1`, 1.04): hero headline (max 16ch, centered, balanced), studio card names PRETTY/VIBE (letter-spacing .02em), price amounts in ink.
- **Headline** (400, `--fs-2`, 1.04): section headings, balanced; also the step numerals in LED blue. In the three-reasons grid at 1000px+ it steps down to clamp(1.75rem, 2.4vw, 2.25rem).
- **Title** (Hanken 600, `--fs-0`, 1.35): `.h3` item titles, FAQ questions, the "Außerdem" subheading. Titles are sans, not Didone.
- **Lead** (400, `--fs-3`, 1.45): hero sub-line only (max 38ch); drops to `--fs-0` under 600px.
- **Body** (400, `--fs-0`, 1.65): running text, `text-wrap: pretty`.
- **Label** (600, `--fs-s`, .06em, uppercase from base, Slate Ink): data labels inside price cards, booking info boxes, house rules and footer columns. Buttons and nav use the same size at 600/500 without uppercase.

### Named Rules
**The Self-Carrying Headline Rule.** No overline above a heading. The heading states the point on its own; labels exist only to name data inside a box or list.

**The Five Sizes Rule.** Five sizes only (`--fs-1`, `--fs-2`, `--fs-3`, `--fs-0`, `--fs-s`), redefined for this world; the single in-place exception is the reasons-grid headline step-down.

## Layout

Single-column flow of full-width bands, each padded by `--sec` (clamp(80px, 10vw, 152px)) and holding a 1240px wrap with a fluid gutter. Splits run text/photo at 6fr/5fr (intro) or 1fr/1fr (audiences, alternating sides) from 900px. The intro pairs two photos in a 3fr/2fr grid with an 8px gap, bottom-aligned, no rotation or overlap. The image strip runs four photos edge to edge with 4px gaps (two columns under 640px). Studio cards sit two-up from 760px. Lists (perks, facts, features, reasons, steps) are multi-column grids of ruled rows, 40px column gap.

Mobile (under 700px): the hero fact row turns into a centered, 320px stacked list ruled top and bottom; audience buttons stack full-width with the primary on top; the hero scrim darkens evenly. Under 900px the fixed booking bar appears. The nav collapses into a full-screen Didone list under 1100px.

## Elevation & Depth

Flat. `--shadow` is `none`; buttons, cards, reviews, price cards, the booking frame and slider controls carry no shadow and no lift on hover. Depth comes from photographs under ink scrims and from the white/grey band alternation. The header gains a 1px hairline (not a shadow) once scrolled.

### Shadow Vocabulary
- **Floating bar** (`box-shadow: 0 10px 30px -12px rgba(10,12,30,.55)`; .4 on the phone button): the mobile booking bar only, because it floats over content.

### Named Rules
**The Flat Floor Rule.** Nothing on the page casts a shadow except the one element that genuinely floats.

## Shapes

Small, consistent corners: 4px on buttons, captions, slider buttons and the review score; 6px on photos, cards, price cards, review, booking frame, consent and info boxes. Pills (999px) survive only on the outlined chips. Borders are 1px throughout: Hairline for dividers and outlines, Ink Navy for the stronger top rules that open a perk, USP or reason. Hero tags and fact items are bare text with hairlines or underlines, never pills or frosted glass.

## Components

### Buttons
Rectangular, quiet, decisive.
- **Shape:** gently squared (4px), 1px border, 52px tall, 30px side padding; small variant 44px / 20px.
- **Primary:** LED Blue fill, white Hanken 600 at `--fs-s`, letter-spacing .02em.
- **Hover / Focus:** colour change only (Deep LED Blue); no translate, no glow. Focus is base's 3px outline, ink on light, white on photos.
- **Line:** transparent with Ink Navy border and text; hover fills Ink Navy with white text. Used on price cards and as the secondary choice on light bands.
- **Ghost (on photos):** white outline, hover adds a 16% white wash.

### Chips
- **Style:** transparent, 1px Hairline outline, Ink Navy text, pill, 6px 14px. Occasion tags under the audience copy; one colour, no rotation of hues.

### Cards / Containers
- **Price card:** Paper White on Cool Mist, 1px Hairline, 6px, centered; label, Didone amount in ink, line button.
- **Review badge:** 1px Hairline, 6px; hover only darkens the border to Slate Ink.
- **Booking info boxes / frame:** 1px Hairline, 6px, no shadow.
- **Ruled lists (perks, USPs, reasons, facts, features, steps, FAQ):** no fill, no radius; a top rule (Ink Navy for perks/USPs/reasons, Hairline for facts/steps) or bottom rule (features, FAQ). Feature checks are bare LED-blue icons.

### Navigation
- **Header:** transparent over the hero with white logo mask, Hanken 500 links and an LED-blue "Termin buchen" button on the right; once scrolled, 97% white with a 1px hairline and no blur. Hover/current link draws a 1px currentColor underline.
- **Mobile:** burger opens a full-screen list of Didone `--fs-2` links divided by hairlines.

### Hero
Full-viewport photo with an ink scrim heavier at the foot, centered Didone headline, one lead line, primary and ghost buttons, then a fact row of four items split by 55% white vertical hairlines. Photo credit tag bottom right as underlined text.

### Studio Cards (signature)
PRETTY and VIBE as two large 4:5 photo cards side by side, 6px corners, ink scrim from 45% down, Didone name at `--fs-1` and a white text link. On hover the photo zooms to 1.035 over 1.6s (cubic-bezier(.16,1,.3,1)). This is the one place the page moves on purpose.

### Footer
Navy band with label-headed columns, Booking.com trust badge (6px), Periwinkle links on hover.

## Do's and Don'ts

### Do:
- **Do** lead every marketing page (home, studio, audience) with a real studio photo under an ink scrim and a centered Didone headline.
- **Do** alternate Paper White and Cool Mist bands; keep navy for the footer.
- **Do** reserve LED Blue for buttons, links and numerals.
- **Do** separate content with 1px hairlines; use a box only for price cards and booking information.
- **Do** keep corners at 4px for controls and 6px for containers.
- **Do** keep the studio-card slow zoom (1.035, 1.6s) as the single hover effect with presence.

### Don't:
- **Don't** put overlines or kickers above headings.
- **Don't** use pastel tiles, colour dots, blobs, gradient banners or coloured scrims.
- **Don't** add shadows or hover lifts to buttons, cards or badges; only the mobile booking bar floats.
- **Don't** introduce a second accent or tint sections with LED Blue.
- **Don't** use pills or frosted glass for facts, tags or captions; chips are the only pills.
