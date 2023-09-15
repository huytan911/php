<section>
    <section><?=$alert ?? ""?></section>
    <h1>Sign up</h1>
    <section>
        <form method="POST">
            <section>
                <label>Username: </label><input type="text" name="username" required>
            </section>
            <section>
                <label>Password: </label><input type="password" name="password" required>
            </section>
            <section>
                <label>Full name: </label><input type="text" name="fullname" required>
            </section>
            <section>
                <label>Mobile: </label><input type="tel" name="mobile" required>
            </section>
            <section>
                <label>Address: </label><textarea name="address" required></textarea>
            </section>
            <section>
                <label>Email: </label><input type="email" name="email">     
            </section>
            <section>
                <input type="submit" value="Signup">
            </section>
        </form>
    </section>
</section>