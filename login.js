const express = require('express');
const router = express.Router();
const { db } = require('../server');
const bcrypt = require('bcryptjs');

router.post('/', (req, res) => {
    const { username, password } = req.body;

    const query = 'SELECT * FROM users WHERE username = ?';
    db.query(query, [username], (err, results) => {
        if (err) throw err;

        if (results.length > 0) {
            bcrypt.compare(password, results[0].password, (err, isMatch) => {
                if (err) throw err;

                if (isMatch) {
                    res.send('Login Successful');
                } else {
                    res.send('Invalid Password');
                }
            });
        } else {
            res.send('User Not Found');
        }
    });
});

module.exports = router;
