import { z } from 'zod'
import { FastifyReply, FastifyRequest } from 'fastify'
import { MakeGetByIdCarsUseCase } from '@/use-cases/factories/make-car-factory'
import { ResourceNotFoundError } from '@/use-cases/errors/resource-not-found-error'

export async function getAllCarsController(
  request: FastifyRequest,
  reply: FastifyReply,
) {
  const getByIdCarBodySchema = z.object({
    carId: z.string().uuid(),
  })

  const { carId } = getByIdCarBodySchema.parse(request.body)

  try {
    const getCarByIdUseCase = MakeGetByIdCarsUseCase()

    const car = await getCarByIdUseCase.execute({
      carId,
    })

    return reply.status(201).send({
      car,
    })
  } catch (error) {
    if (error instanceof ResourceNotFoundError) {
      return reply.status(404).send({ message: error.message })
    }

    throw error
  }
}
