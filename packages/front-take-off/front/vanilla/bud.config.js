/**
 * @typedef {import('@roots/bud').Bud} Bud
 *
 * @param {Bud} bud
 */
module.exports = async bud => {
    bud.externals({
        jQuery: 'window.jquery',
        wp: 'window.wp',
        react: 'window.React'
    })
    await bud
        .setPath('@dist', '../assets')
        .entry({
            app: 'app.js',
        })
        .when( bud.isProduction, () => bud.splitChunks().minimize() )
}
