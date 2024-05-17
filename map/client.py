import requests

# res = requests.get("http://127.0.0.1:8000")

# res = requests.get("http://127.0.0.1:8000/fukuoka_city_hall")

res = requests.get("http://127.0.0.1:8000/location/location1")
print(res.status_code)
print(res.json())