<!DOCTYPE html>
<html lang="ru">
<head>
<meta charset="UTF-8">
<title>Форма</title>

<style>
* {
  box-sizing: border-box;
}

body {
  margin: 0;
  font-family: 'Segoe UI', Arial, sans-serif;
  background: linear-gradient(135deg, #74ebd5, #ACB6E5);
}

.container {
  max-width: 500px;
  margin: 50px auto;
  background: #ffffff;
  padding: 30px;
  border-radius: 15px;
  box-shadow: 0 10px 30px rgba(0,0,0,0.2);
}

h2 {
  text-align: center;
  margin-bottom: 20px;
}

label {
  display: block;
  margin-top: 15px;
  font-weight: 600;
}

input, select, textarea {
  width: 100%;
  margin-top: 5px;
  padding: 10px;
  border-radius: 8px;
  border: 1px solid #ccc;
  transition: 0.3s;
  font-size: 14px;
}

input:focus, select:focus, textarea:focus {
  border-color: #4CAF50;
  outline: none;
  box-shadow: 0 0 5px rgba(76,175,80,0.5);
}

.radio-group, .checkbox-group {
  margin-top: 10px;
}

.radio-group label,
.checkbox-group label {
  display: inline-block;
  margin-right: 15px;
  font-weight: normal;
}

select[multiple] {
  height: 120px;
}

button {
  width: 100%;
  margin-top: 20px;
  padding: 12px;
  border: none;
  border-radius: 8px;
  background: linear-gradient(135deg, #4CAF50, #2e7d32);
  color: white;
  font-size: 16px;
  cursor: pointer;
  transition: 0.3s;
}

button:hover {
  background: linear-gradient(135deg, #45a049, #1b5e20);
  transform: scale(1.02);
}
</style>
</head>

<body>

  <div class="container">
  <h2>Форма регистрации</h2>

  <form action="index.php" method="POST">

    <label>ФИО:</label>
    <input type="text" name="name" required>

    <label>Телефон:</label>
    <input type="tel" name="phone" required>

    <label>Email:</label>
    <input type="email" name="email" required>

    <label>Дата рождения:</label>
    <input type="date" name="birthdate" required>

    <label>Пол:</label>
    <div class="radio-group">
      <label><input type="radio" name="gender" value="male"> Муж</label>
      <label><input type="radio" name="gender" value="female"> Жен</label>
    </div>

    <label>Любимый язык программирования:</label>
    <select name="languages[]" multiple>
      <option value="1">Pascal</option>
      <option value="2">C</option>
      <option value="3">C++</option>
      <option value="4">JavaScript</option>
      <option value="5">PHP</option>
      <option value="6">Python</option>
      <option value="7">Java</option>
      <option value="8">Haskel</option>
      <option value="9">Clojure</option>
      <option value="10">Prolog</option>
      <option value="11">Scala</option>
      <option value="12">Go</option>
    </select>

    <label>Биография:</label>
    <textarea name="bio" rows="4"></textarea>

    <div class="checkbox-group">
      <label>
        <input type="checkbox" name="contract"> С контрактом ознакомлен
      </label>
    </div>

    <button type="submit">Сохранить</button>

  </form>
</div>

</body>
</html>