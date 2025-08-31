import express from "express";
import mongoose from "mongoose";
import bcrypt from "bcrypt";
import dotenv from "dotenv";
import cors from "cors";

dotenv.config();
const app = express();

app.use(cors());
app.use(express.json());

// --- DB connection ---
mongoose.connect(process.env.MONGODB_URI, { autoIndex: true })
  .then(() => console.log("MongoDB connected"))
  .catch(err => console.error("Mongo error:", err));

// --- Schema ---
const userSchema = new mongoose.Schema({
  username: { type: String, required: true, trim: true },
  email:    { type: String, required: true, unique: true, lowercase: true },
  password: { type: String, required: true } // bcrypt hash
}, { timestamps: true });

const User = mongoose.model("User", userSchema);

// --- Routes ---
app.post("/api/signup", async (req, res) => {
  try {
    const { username, email, password } = req.body;
    if (!username || !email || !password)
      return res.json({ success: false, message: "All fields are required" });

    const exists = await User.findOne({ email });
    if (exists) return res.json({ success: false, message: "Email already registered" });

    const hashed = await bcrypt.hash(password, Number(process.env.BCRYPT_ROUNDS) || 12);
    await User.create({ username, email, password: hashed });

    res.json({ success: true });
  } catch (err) {
    console.error(err);
    res.status(500).json({ success: false, message: "Server error" });
  }
});

// --- Run ---
app.listen(process.env.PORT || 3000, () =>
  console.log(`Server running at http://localhost:${process.env.PORT || 3000}`)
);
