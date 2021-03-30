const {dbRead} = require("../../../Database/query");

const readBanners = async(req, res) => {
    const getBannerData = async () => {
        return {
            slides: await dbRead.getReadInstance().getFromDb({
                table: 'banners',
            }),
            adBoxes: await dbRead.getReadInstance().getFromDb({
                table: 'ad_boxes',
                order: ['box_number ASC']
            })
        };
    }

    try {
        const data = await getBannerData();

        res.render('pages/sliders', {Title: 'Products', layout: './layouts/nav', sliderInfo: data});
    } catch(error) {
        console.log(error);
    }
}

module.exports = {
    readBanners
}
