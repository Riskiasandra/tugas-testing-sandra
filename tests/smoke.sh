#!/bin/sh

echo "Running smoke test..."

# Cek apakah index.php bisa diakses
if php -l public/index.php > /dev/null 2>&1; then
  echo "index.php OK"
else
  echo "index.php ERROR"
  exit 1
fi

# Cek file lain jika ada
for file in login.php register.php beranda.php logout.php koneksi.php; do
  if [ -f "public/$file" ]; then
    if php -l "public/$file" > /dev/null 2>&1; then
      echo "$file OK"
    else
      echo "$file ERROR"
      exit 1
    fi
  fi
done

echo "Smoke test finished successfully!"
