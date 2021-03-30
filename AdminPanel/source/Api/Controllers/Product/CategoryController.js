const {CategoryService} = require("../../Services");
const {validationResult} = require("express-validator");
const {dbRead} = require("../../../Database/query");
const {alert} = require('../../Helpers');

const createCategory = async(req, res) => {
    const errors = validationResult(req);

    if(!errors.isEmpty()) {
        const error = errors.array()[0];
        alert(req, 'info', 'Something is missing!', error.msg);
        return res.redirect('back');
    }

    const {title, sections} = req.body;

    try {
        CategoryService.createCategory(title, sections)
            .then(data => {
                if(data === 1) {
                    alert(req, 'success', 'Success!', 'Category Created.')
                } else {
                    alert(req,'danger', 'Error!', 'Unable to add.')
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
                columns: 'categories.id, categories.title, categories.status, section.title AS sectionTitle',
                join: [['categories AS section', 'section.id = categories.section_id']],
                where: [['categories.section_id', 'IS NOT', 'NULL'], ['categories.category_id', 'IS', 'NULL']],
                orderBy: ['categories.updated_at DESC']
            }),
            subCategories: await dbRead.getReadInstance().getFromDb({
                table: 'categories',
                columns: 'categories.id, categories.title, categories.status, cat.title AS catTitle, ' +
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
const updateCategory = async(req, res) => {
    const {category_id, title, section} = req.body;

    try {
        CategoryService.updateCategory(category_id, title, section)
            .then(data => {
                if(data === 1) {
                    alert(req, 'success','Success', 'Category updated');
                } else {
                    alert(req, 'danger', 'Error!', 'Something went wrong!');
                }
                res.redirect('back');
            });
    } catch(error) {
        console.log(error);
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
        alert(req, "info", '', 'Sub-Category deleted.');
    }
}

const createSubCategory = async(req, res) => {
    const {section, category, title} = req.body;

    try {
        CategoryService.createSubCategory(title, section, category)
            .then(data => {
                if(data === 1) {
                    alert(req, 'success', 'Success', 'Sub-Category created.');
                } else {
                    alert(req, 'danger', 'Oops!', 'Unable to add Sub-Category');
                }
                res.redirect('back');
            }).catch(err => {
            console.log(err.message);
            alert(req, 'danger', 'Error!', 'Something went wrong during Insertion!');
        });
    } catch(error) {
        console.log(error);
        alert(req, 'danger', 'Error!', 'Something went wrong!');
    }
}
const updateSubCategory = async(req, res) => {
    const {sub_category_id, category, title, section} = req.body;

    try {
        CategoryService.updateSubCategory(sub_category_id, title, section, category)
            .then(data => {
                if(data === 1) {
                    alert(req, 'success','Success', 'Category updated');
                } else {
                    alert(req, 'danger', 'Error!', 'Something went wrong!');
                }
                res.redirect('back');
            });
    } catch(error) {
        console.log(error);
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
