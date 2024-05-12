import { FastifyInstance } from 'fastify'
import { createCarController } from './controllers/create-car-controller'

export async function carsRoutes(app: FastifyInstance) {
  app.post('/cars', createCarController)
}
