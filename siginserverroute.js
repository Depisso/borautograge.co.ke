// Signin route
app.post("/api/signin", async (req, res) => {
  const { email, password } = req.body;

  const user = users.find(u => u.email === email);
  if (!user) {
    return res.json({ success: false, message: "User not found" });
  }

  const valid = await bcrypt.compare(password, user.password);
  if (!valid) {
    return res.json({ success: false, message: "Invalid password" });
  }

  res.json({ success: true, message: "Login successful", user: { username: user.username, email: user.email } });
});
