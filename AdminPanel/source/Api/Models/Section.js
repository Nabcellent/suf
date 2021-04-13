const knex = require('knex');
const config = require('../../../knexfile');
const db = knex(config.development);
let created_at  = new Date();
let updated_at = new Date();


/**____________________________________________________________
 *  FETCH METHODS
 * ____________________________________________________________*/
const withCategories = () => {
    try {
        return new Promise((resolve, reject) => {
            db('categories').where({section_id: null, category_id: null})
                .then(async sections => {
                    for(const section of sections) {
                        section.categories = await db('categories').where({section_id: section.id, category_id: null})
                            .then(async categories => {
                                for(const category of categories) {
                                    category.subCategories = await db('categories').where('category_id', category.id)
                                        .then(async subCategories => {
                                            return subCategories;
                                        }).catch(err => reject(err));
                                }
                                return categories;
                            }).catch(err => reject(err));
                    }
                    resolve(sections);
                }).catch(err => reject(err));
        });
    } catch (e) {
        return e;
    }
}



module.exports = {
    withCategories
}
