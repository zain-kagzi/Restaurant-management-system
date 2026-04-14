const sr = ScrollReveal({
    origin: 'top',
    distance: '60px',
    duration: 2000,
    delay: 400,
    // reset: true
  })
  sr.reveal(`.top, #menuContainer,.featured__filters`)
  sr.reveal(`.bottom, .popular__container,.features__img,.featured__filters`,{
    origin:'bottom'
  })
  sr.reveal(`.top1`, {delay: 500})
  sr.reveal(`.top2`, {delay: 600})
  sr.reveal(`.top3`, {delay: 800})
  sr.reveal(`.top4`, {delay: 900})
  sr.reveal(`.home__car-data`, {delay: 900,interval: 100, origin: 'bottom'})
  sr.reveal(`.home__button`, {delay: 900, origin: 'bottom'})
  sr.reveal(`.nav-link, .logo, .left`, {origin: 'left'})
  sr.reveal(`.login1,.offer__img ,.right`, {origin: 'right'})
  sr.reveal(`.features__map`, { delay:600, origin: 'bottom'})
  sr.reveal(`.features__card`, { interval: 300})
  sr.reveal(`.featured__card,.logos__content,.footer__content`, { interval: 100})

  