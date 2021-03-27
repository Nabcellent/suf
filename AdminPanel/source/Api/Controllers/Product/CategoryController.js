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

    const {title, categories} = req.body;

    try {
        CategoryService.createCategory(title, categories)
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
                where: [
                    ['category_id', 'IS', 'NULL'],
                    ['sub_category_id', 'IS', 'NULL']
                ]
            }),
            categories: await CategoryService.readCategories()
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
    const {category_id, title} = req.body;

    try {
        CategoryService.updateCategory(category_id, title)
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
};
const updateCategoryStatus = async(req, res) => {
    const {status, sub_category_id} = req.body;
    let newStatus = (status === 'Active') ? 0 : 1;

    try {
        CategoryService.updateCategoryStatus(sub_category_id, newStatus)
            .then((data) => {
                if(data === 1) {
                    alert(req, 'success', '', 'Status Updated!');
                    return res.json({status: newStatus});
                } else {
                    alert(req, 'danger', 'Error!', 'Something went wrong!');
                    return res.json({errors: {message: 'Internal error. Contact Admin'}});
                }
            }).catch(error => console.log(error));
    } catch(error) {
        console.log(error);
        alert(req, 'danger', 'Error!', 'Something went wrong!');
        res.redirect('back');
    }
}
const deleteCategory = async(req, res) => {
    const {sub_category_id} = req.body;

    try {
        CategoryService.deleteSubCategory(sub_category_id)
            .then(data => {
                if(data === 1) {
                    alert(req, "info", '', 'Category deleted.');
                } else {
                    alert(req, 'danger', 'Error!', 'Something went wrong!');
                }
                res.redirect('back');
            });
    } catch(error) {
        console.log(error);
        alert(req, "info", '', 'Sub-Category deleted.');
    }
}

const createSubCategory = async(req, res) => {
    const {section_id, category_id, title} = req.body;

    try {
        CategoryService.createSubCategory(title, section_id, category_id)
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

module.exports = {
    createCategory,
    readCategories,
    updateCategory,
    deleteCategory,

    updateCategoryStatus,

    createSubCategory,
}
