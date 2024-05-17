from fastapi import FastAPI, Response
from fastapi.middleware.cors import CORSMiddleware

app = FastAPI()

# async def app(scope, receive, send):
#     assert scope['type'] == 'https'

#     await send({
#         'type': 'https.response.start',
#         'status': 200,
#         'headers': [
#             [b'content-type', b'text/plain'],
#         ],
#     })
#     await send({
#         'type': 'https.response.body',
#         'body': b'Hello, world!',
#     })

# CORSポリシーの設定
app.add_middleware(
    CORSMiddleware,
    # allow_origins=["http://localhost:8888",
    #                "https://www.orangefrog14.com/",
    #                "https://www.49.212.211.17:8000"],
    allow_origins=["*"],
    allow_credentials=True,
    allow_methods=["GET", "POST", "PUT", "DELETE", "OPTIONS"],
    allow_headers=["*"],
)



locations = [
    {
        "name": "Great_Barrier_Reef",
        "country": "Australia",
        "latitude": -18.2871,
        "longitude": 147.6992
    },
    {
        "name": "Grand_Canyon",
        "country": "United_States",
        "latitude": 36.1069,
        "longitude": -112.1129
    },
    {
        "name": "Statue_of_Liberty",
        "country": "United_States",
        "latitude": 40.6892,
        "longitude": -74.0445
    },
    {
        "name": "CN_Tower",
        "country": "Canada",
        "latitude": 43.6426,
        "longitude": -79.3871
    },
    {
        #cafe
        "name": "Vienna",
        "country": "Austria",
        "latitude": 48.2082,
        "longitude": 16.3738
    },
    {
        # bar
        "name": "New Orleans",
        "State": "Louisiana",
        "country": "USA",
        "latitude": 29.9511,
        "longitude": -90.0715
    },
    {
        # camp
        "name": "Yosemite National Park",
        "country": "United_States",
        "latitude": 37.8651,
        "longitude": -119.5383
    },
    {
        # resort
        "name": "Bali",
        "Country": "Indonesia",
        "latitude": -8.3405,
        "longitude": 115.092
    }
]


@app.get("/location/{location_name}")
async def get_location(location_name: str, response: Response):
    location_data = next((loc for loc in locations if loc["name"] == location_name), {})
    return location_data
