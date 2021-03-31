const {dbRead} = require("../../../Database/query");

const readAds = async(req, res) => {
    const getBannerData = async () => {
        return {
            adBoxes: await dbRead.getReadInstance().getFromDb({
                table: 'ad_boxes',
                order: ['box_number ASC']
            })
        };
    }

    try {
        const data = await getBannerData();

        res.render('page-content/ad_boxes', {Title: 'Products', layout: './layouts/nav', sliderInfo: data});
    } catch(error) {
        console.log(error);
    }
}

module.exports = {
    readAds
}
