#!/usr/bin/env bash
set -euo pipefail

BASE="http://127.0.0.1:8080"
# start server in background serving public/
php -S 127.0.0.1:8080 -t public/ > server.log 2>&1 &
PID=$!
sleep 2

# wait for server
for i in $(seq 1 10); do
  if curl -sSf "$BASE/login.php" >/dev/null 2>&1; then
    break
  fi
  sleep 1
done

echo "Checking login.php"
curl -sSf -o /dev/null "$BASE/login.php"
echo "Checking register.php"
curl -sSf -o /dev/null "$BASE/register.php"
echo "Checking dashboard redirect (may 302)"
STATUS=$(curl -s -o /dev/null -w "%{http_code}" "$BASE/")
echo "Root returned HTTP $STATUS"

kill $PID || true
echo "Smoke tests passed."
