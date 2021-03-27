const json = require("body-parser");
const {dbRead} = require("../../Database/query");


const getAttributeValueById = async (req, res) => {
    const {name} = req.params;

    try {
        const result = await dbRead.getReadInstance().getFromDb({
            table: 'attributes',
            where: [['name', '=', name]],
            limit: 1
        })

        res.json(result[0].values);
    } catch(error) {
        console.log(error);
    }
}
const getCategoryBySection = async(req, res) => {
    const {id} = req.params;

    const data = await dbRead.getReadInstance().getFromDb({
        table: 'categories',
        columns: 'id, title',
        where: [
            ['category_id', '=', id],
            ['sub_category_id', 'IS', 'NULL']
        ]
    });

    res.json(data);
}

module.exports = {
    getAttributeValueById,
    getCategoryBySection
}
/**********
 * JQUERY CONTROLLER
 * ******/

