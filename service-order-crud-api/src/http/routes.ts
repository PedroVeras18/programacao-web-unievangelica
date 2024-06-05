import { FastifyInstance } from 'fastify'
import { authenticate } from './controllers/authenticate-user-controller'
import { register } from './controllers/register-controller'

export async function applicationRoutes(app: FastifyInstance) {
  app.post('/authentication', authenticate)
  app.post('/register', register)
}
