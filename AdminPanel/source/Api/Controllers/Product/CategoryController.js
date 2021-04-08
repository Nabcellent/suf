const createError = require("http-errors");
const {CategoryService} = require("../../Services");
const {validationResult} = require("express-validator");
const {dbRead} = require("../../../Database/query");
const {alertUser} = require('../../Helpers');

const createCategory = async(req, res) => {
    const errors = validationResult(req);

    if(!errors.isEmpty()) {
        const error = errors.array()[0];
        alertUser(req, 'info', 'Something is missing!', error.msg);
        return res.redirect('back');
    }

    const {title, sections, discount, description} = req.body;

    try {
        CategoryService.createCategory(title, sections, discount, description)
            .then(data => {
                if(data === 1) {
                    alertUser(req, 'success', 'Success!', 'Category Created.')
                } else {
                    alertUser(req,'danger', 'Error!', 'Unable to add.')
                }
                res.redirect('back');
            }).catch(err => console.log(err));
    } catch (error) {
        console.log(error);
        res.status(502).send("something wrong!");
    }
}
const readCategories = async(req, res) => {
    const getCategories = async () => {
        return {
            sections: await dbRead.getReadInstance().getFromDb({
                table: 'categories',
                columns: 'id, title, status',
                where: [
                    ['section_id', 'IS', 'NULL'],
                    ['category_id', 'IS', 'NULL']
                ]
            }),
            categories: await dbRead.getReadInstance().getFromDb({
                table: 'categories',
                columns: 'categories.id, categories.title, categories.description, categories.status, categories.discount, ' +
                    'section.title AS sectionTitle, section.id AS section_id',
                join: [['categories AS section', 'section.id = categories.section_id']],
                where: [['categories.section_id', 'IS NOT', 'NULL'], ['categories.category_id', 'IS', 'NULL']],
                orderBy: ['categories.updated_at DESC']
            }),
            subCategories: await dbRead.getReadInstance().getFromDb({
                table: 'categories',
                columns: 'categories.id, categories.title, categories.description, categories.status, cat.title AS catTitle, ' +
                    'section.id AS sectionId, section.title AS sectionTitle',
                join: [
                    ['categories AS cat', 'categories.category_id = cat.id'],
                    ['categories AS section', 'categories.section_id = section.id'],
                ],
                orderBy: ['categories.updated_at DESC']
            })
        };
    }

    try {
        const data = await getCategories();

        res.render('products/categories', {Title: 'Categories', layout: './layouts/nav', categoryInfo: data});
    } catch(error) {
        console.log(error);
    }
}
const updateCategory = async(req, res, next) => {
    const {category_id, title, section, discount, description} = req.body;

    try {
        CategoryService.updateCategory(category_id, title, section, discount, description)
            .then(response => {
                if(response instanceof Error) {
                    throw createError(404, response);
                } else if(response === 1) {
                    alertUser(req, 'success', 'Success!', 'Category updated.');
                } else {
                    throw createError(404, 'Something went wrong');
                }
                res.redirect('back');
            });
    } catch(error) {
        next(error);
    }
}
const deleteCategory = async(req, res) => {
    const {id} = req.params;

    try {
        CategoryService.deleteCategory(id)
            .then(data => {
                res.json(data);
            });
    } catch(error) {
        console.log(error);
        alertUser(req, "info", '', 'Sub-Category deleted.');
    }
}

const createSubCategory = async(req, res, next) => {
    const {section, category, title, description} = req.body;

    try {
        CategoryService.createSubCategory(title, section, category, description)
            .then(response => {
                if(response instanceof Error) {
                    throw createError(404, response);
                } else if(response === 1) {
                    alertUser(req, 'success', 'Success!', 'Sub-Category created.');
                } else {
                    throw createError(404, 'Something went wrong');
                }
                res.redirect('back');
            }).catch(err => next(err));
    } catch(error) {
        next(error);
        alertUser(req, 'danger', 'Error!', 'Something went wrong!');
    }
}
const updateSubCategory = async(req, res, next) => {
    const {sub_category_id, category, title, section, description} = req.body;

    try {
        CategoryService.updateSubCategory(sub_category_id, title, section, category, description)
            .then(response => {
                if(response instanceof Error) {
                    throw createError(404, response);
                } else if(response === 1) {
                    alertUser(req, 'success', 'Success!', 'Category updated.');
                } else {
                    throw createError(404, 'Something went wrong');
                }
                res.redirect('back');
            });
    } catch(error) {
        next(error);
    }
}

const updateCategoryStatus = async(req, res) => {
    const {status, category_id} = req.body;
    let newStatus = (status === 'Active') ? 0 : 1;

    try {
        CategoryService.updateCategoryStatus(category_id, newStatus)
            .then((data) => {
                if(data === 1) {
                    return res.json({status: newStatus});
                } else {
                    return res.json({errors: {message: 'Internal error. Contact Admin'}});
                }
            }).catch(error => console.log(error));
    } catch(error) {
        console.log(error);
        res.redirect('back');
    }
}

module.exports = {
    createCategory,
    readCategories,
    updateCategory,
    deleteCategory,

    createSubCategory,
    updateSubCategory,

    updateCategoryStatus
}
