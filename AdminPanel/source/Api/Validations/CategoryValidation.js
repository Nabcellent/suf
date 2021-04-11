const {check} = require("express-validator");
const knex = require('knex');
const config = require('../../../knexfile');
const db = knex(config.development)

module.exports = {
    categoryCreate: () => {
        return [
            check("title", "Category title is required")
                .not().isEmpty()
                .custom(async (value, {req}) => {
                    const {sections} = req.body;
                    let notExists, result;
                    result = db('categories');

                    if(typeof sections === 'string') {
                        result.where({title: value, section_id: sections})
                    } else if(Array.isArray(sections)) {
                        result.where({title: value})
                            .whereIn('section_id', sections)
                    }

                    notExists = await result.then((rows) => {
                        return rows.length === 0;
                    });

                    if(notExists) {
                        return true;
                    }
                    throw new Error('This category already exists for the selected section(s)!');
                }),
        ]
    },

    update: () => {
        return [
            check("name", "Name is required").not().isEmpty(),
        ]
    }
}
