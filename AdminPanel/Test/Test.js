

module.exports = {
    test: async (req, res) => {
        db('categories').insert([
            {title: 'chapati', section_id: 3, category_id: 5},
            {title: 'smocha', section_id: 2, category_id: 8}
        ])
            .then(rows => {
                console.log(rows);
                console.log(rows.length);
            }).catch(err => console.log(err.message));

        res.json("what");
    }
}
